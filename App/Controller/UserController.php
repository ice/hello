<?php

namespace App\Controller;

use App\Model\Users;
use Ice\Validation;

/**
 * User controller
 *
 * @package     Ice/Hello
 * @category    Controller
 */
class UserController extends IndexController
{

    /**
     * Display sign up form
     */
    public function getSignupAction()
    {
        
    }

    /**
     * Sign up new user
     */
    public function postSignupAction()
    {
        $post = $this->request->getPost()->all();

        $validation = new Validation();
        $validation->rules([
            'name' => 'required',
            'email' => 'required|email|unique:users',
        ]);

        $valid = $validation->validate($post);

        if (!$valid) {
            echo 'Warning! Please correct the errors:<br />';
            foreach ($validation->getMessages() as $message) {
                echo $message[0] . '<br />';
            }
        } else {
            $user = new Users();
            $user->setFields(['name', 'email']);

            if ($user->create($post)) {
                echo "Thanks for registering!";
            }
        }

        $this->view->setContent(false);
    }

    /**
     * Display all users
     */
    public function indexAction()
    {
        $this->view->setVar('users', Users::find());
    }
}
