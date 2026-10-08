<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\Files\UploadedFile;
use RuntimeException;
use Throwable;

class UserAccounts extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();

        $data['users'] = $userModel->findAll();

        return view('user_accounts', $data);
    }

    public function new()
    {
        return view('user_form', [
            'title'  => 'New User',
            'user'   => null,
            'action' => site_url('users'),
        ]);
    }

    public function create()
    {
        $rules = [
            'username'  => 'required|max_length[50]|is_unique[users.username]',
            'full_name' => 'required|max_length[100]',
            'password'  => 'required|min_length[8]|max_length[72]',
        ];

        $messages = [
            'username' => [
                'is_unique' => 'That username is already in use.',
            ],
        ];

        if (! $this->validate($rules, $messages)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        (new UserModel())->insert([
            'username'   => trim((string) $this->request->getPost('username')),
            'full_name'  => trim((string) $this->request->getPost('full_name')),
            'password'   => password_hash((string) $this->request->getPost('password'), PASSWORD_DEFAULT),
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to(site_url('users'))->with('success', 'User account created successfully.');
    }

    public function edit(int $id)
    {
        $user = (new UserModel())->find($id);

        if ($user === null) {
            throw PageNotFoundException::forPageNotFound('User not found.');
        }

        return view('user_form', [
            'title'  => 'Edit User',
            'user'   => $user,
            'action' => site_url('users/' . $id),
        ]);
    }

    public function update(int $id)
    {
        $userModel = new UserModel();
        $user      = $userModel->find($id);

        if ($user === null) {
            throw PageNotFoundException::forPageNotFound('User not found.');
        }

        $rules = [
            'username'  => "required|max_length[50]|is_unique[users.username,id,{$id}]",
            'full_name' => 'required|max_length[100]',
            'password'  => 'permit_empty|min_length[8]|max_length[72]',
        ];

        $messages = [
            'username' => [
                'is_unique' => 'That username is already in use.',
            ],
        ];

        if (! $this->validate($rules, $messages)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $avatar       = $this->request->getFile('avatar');
        $avatarName   = $user['avatar'] ?? null;
        $uploadedName = null;

        if ($avatar instanceof UploadedFile && $avatar->getError() !== UPLOAD_ERR_NO_FILE) {
            $avatarRules = [
                'avatar' => [
                    'label' => 'Profile picture',
                    'rules' => 'uploaded[avatar]|max_size[avatar,2048]|is_image[avatar]|mime_in[avatar,image/jpg,image/jpeg,image/png]|ext_in[avatar,jpg,jpeg,png]',
                ],
            ];

            if (! $this->validate($avatarRules)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            try {
                $uploadedName = $this->prepareAvatar($avatar);
                $avatarName   = $uploadedName;
            } catch (Throwable $exception) {
                log_message('error', 'Avatar preparation failed: {message}', ['message' => $exception->getMessage()]);

                return redirect()->back()->withInput()->with('errors', [
                    'avatar' => 'The profile picture could not be prepared. Please try another JPG or PNG image.',
                ]);
            }
        }

        $updateData = [
            'username'  => trim((string) $this->request->getPost('username')),
            'full_name' => trim((string) $this->request->getPost('full_name')),
            'avatar'    => $avatarName,
        ];

        $newPassword = (string) $this->request->getPost('password');

        if ($newPassword !== '') {
            $updateData['password'] = password_hash($newPassword, PASSWORD_DEFAULT);
        }

        $updated = $userModel->update($id, $updateData);

        if (! $updated) {
            if ($uploadedName !== null) {
                $this->deleteAvatar($uploadedName);
            }

            return redirect()->back()->withInput()->with('errors', ['account' => 'The user account could not be updated.']);
        }

        if ($uploadedName !== null && ! empty($user['avatar']) && $user['avatar'] !== $uploadedName) {
            $this->deleteAvatar($user['avatar']);
        }

        return redirect()->to(site_url('users'))->with('success', 'User account updated successfully.');
    }

    private function prepareAvatar(UploadedFile $avatar): string
    {
        $extension = strtolower($avatar->getClientExtension());
        $filename  = bin2hex(random_bytes(16)) . '.' . $extension;
        $directory = FCPATH . 'uploads' . DIRECTORY_SEPARATOR . 'avatars';

        if (! is_dir($directory) && ! mkdir($directory, 0755, true) && ! is_dir($directory)) {
            throw new RuntimeException('Unable to create the avatar directory.');
        }

        service('image')
            ->withFile($avatar->getTempName())
            ->fit(256, 256, 'center')
            ->save($directory . DIRECTORY_SEPARATOR . $filename, 85);

        return $filename;
    }

    private function deleteAvatar(string $filename): void
    {
        $safeName = basename($filename);
        $path     = FCPATH . 'uploads' . DIRECTORY_SEPARATOR . 'avatars' . DIRECTORY_SEPARATOR . $safeName;

        if (is_file($path)) {
            unlink($path);
        }
    }
}
