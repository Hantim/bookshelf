<?php

namespace Bookshelf\Controller;
use Bookshelf\Core\Templater;
use Bookshelf\Model\Contacts;
use Bookshelf\Model\User;

/**
 * @author Aleksandr Kolobkov
 */
class LoginController
{
    /**
     * @var string default name for controller
     */
    private $controllName='Login';
    /**
     * @var var for Templater class instance
     */
    private $templater;

    /**
     * Magic function that create templater class instance
     */
    public function __construct()
    {
        $this->templater = new Templater();
    }
    /**
     * Default action for $this class
     */
    public function defaultAction($param)
    {
        $this->loginAction($param);
    }

    /**
     * Show html forms for logIn
     */
    public function loginAction()
    {
        $user = User::findBy('email', $_POST['email']);
        if ($user->getEmail() !== '' && $user->getPassword() === $_POST['password']) {
            $contacts = Contacts::findBy('user_id', $user->getId())->getContactDataForm($user->getId());
            $this->templater->param = ['contactdata' => $contacts];
            $this->templater->show('User', 'AccountPage', $user);
        } else {
            echo 'Oops something wrong';
        }
    }

    /**
     * Method that create login form on page
     */
    public function getLoginForm()
    {
        return $this->templater->render($this->controllName, 'Form', null);
    }

    /**
     * In future will return LogOut page
     */
    public function logoutAction()
    {
        echo "This is logout page";
    }

    /**
     * Method that create register form
     */
    public function registerFormAction()
    {
        $this->templater->show($this->controllName, 'RegisterForm', null);
    }

    /**
     * Create register page and storage user data in array( for now)
     * If passwords don't match recreate register and fill username line with value from last try
     */
    public function registerAction()
    {
        if ($this->verificationData($_POST)) {
            $user = new User();
            $user->setEmail($_POST['email']);
            $user->setFirstName($_POST['firstname']);
            $user->setLastName($_POST['lastname']);
            $user->setPassword($_POST['password']);
            $user->save();
            echo "Welcome {$user->getFirstName()}";
        } else {
            $this->templater->param = ['emailValue' => $_POST['email'], 'firstnameValue' => $_POST['firstname'], 'lastnameValue' => $_POST['lastname']];
            $this->templater->show($this->controllName, 'RegisterForm', null);
        }
    }

    /**
     * Method that check passwords match
     *
     * @param $password
     * @param $confirmPassword
     * @return bool
     */
    private function verificationData($array)
    {
        return ($array['password'] !== '' &&
            $array['confirm_password'] !== '' &&
            $array['firstname'] !=='' &&
            $array['lastname'] !== '' &&
            $array['email'] !== '' &&
            strpos($array['email'], '@') !== false &&
            substr_count($array['email'], '@') === 1 &&
            $array['password'] === $array['confirm_password']);
    }
}
