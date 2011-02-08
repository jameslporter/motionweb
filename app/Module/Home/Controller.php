<?php
namespace Module\Home;
use Alloy;

/**
 * Home Module
 */
class Controller extends Alloy\Module\ControllerAbstract
{
    /**
     * Index
     * @method GET
     */
    public function indexAction(Alloy\Request $request)
    {
    	$greeting = "Hello World";

    	// Returns Alloy\View\Template object that renders template on __toString:
    	//   views/indexAction.html.php
        return $this->template(__FUNCTION__)
        	->set(compact('greeting'));
    }


    /**
     * Return raw string content
     * @method GET
     */
    public function helloAction(Alloy\Request $request)
    {
        return "Hello World!";
    }
}