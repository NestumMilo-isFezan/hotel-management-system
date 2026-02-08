<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;
use App\Repositories\UserRepository;

class AuthController extends Controller
{
    private UserRepository $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function login(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/');
        }

        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $user = $this->userRepository->findByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            Session::set('user', 1);
            Session::set('loggedin_time', time());
            Session::regenerate();

            if ((int)$user['userRoles'] === 2) {
                $guest = $this->userRepository->findGuestByAccId((int)$user['accID']);
                Session::set('guestID', $guest['guestID']);
                echo "guest";
            } else {
                $staff = $this->userRepository->findStaffByAccId((int)$user['accID']);
                Session::set('staffID', $staff['staffID'] ?? null);
                echo "staff";
            }
            return;
        }

        echo "error";
    }

    public function register(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/');
        }

        $username = $_POST['username'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $confirmPwd = $_POST['confirmPwd'] ?? '';
        $fname = $_POST['fname'] ?? '';
        $lname = $_POST['lname'] ?? '';

        if ($password !== $confirmPwd) {
            echo "password not match";
            return;
        }

        if ($this->userRepository->findByEmail($email)) {
            echo "email exist";
            return;
        }

        $pwdHash = password_hash($password, PASSWORD_DEFAULT);
        $accId = $this->userRepository->create([
            'username' => $username,
            'email' => $email,
            'password' => $pwdHash
        ]);

        if ($accId) {
            if ($this->userRepository->createGuest([
                'accId' => $accId,
                'fname' => $fname,
                'lname' => $lname
            ])) {
                echo "passed";
                return;
            }
        }

        echo "sql error";
    }

    public function logout(): void
    {
        Session::destroy();
        $this->redirect('/');
    }
}
