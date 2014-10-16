<?php

namespace Bookshelf\Controller;

use Bookshelf\Core\Session;
use Bookshelf\Core\Templater;
use Bookshelf\Core\TemplaterException;
use Exception;
/**
 * @author Aleksandr Kolobkov
 */
class MainController
{
    /**
     * @var string default name for controller
     */
    private $controllName = 'Main';

    /**
     * @var var for templater instance
     */
    private $templater;

    private $session;

    /**
     * Magic function that create templater instance
     */
    public function __construct()
    {
        try {
            $this->session = new Session();
            $this->templater = new Templater();
        } catch (TemplaterException $e) {
            throw new Exception ('Controller error');
        }
    }

    /**
     * Return default action for $this controller
     */
    public function defaultAction()
    {
        $this->indexAction();
    }

    /**
     * When execute will show Main/IndexView.html
     */
    public function indexAction()
    {
        if ($this->session->getSessionData('logInStatus') === 0) {
            $login = new LoginController();
            $actionName = 'index';
            $param = array(
                "title" => 'Test',
                "text" => 'This is test so relax and be happy',
                "menu" => $login->getLoginForm()
            );
            $this->templater->show($this->controllName, $actionName, $param);
        } else {
            $this->templater->show($this->controllName, 'AccountPage', ['name' => $this->session->getSessionData('email')]);
        }
    }
}

