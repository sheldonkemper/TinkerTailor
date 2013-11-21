<?php
/**
 *@author Engine Kemper
 *@copyright Engine Kemper 2013
 *
 * CLASS Load 
 * Controlles the relationship between the model and view.
 * @todo Will need a superClass once similiar functionality is realised.
 */

namespace Module\index;
use Module\index\model as model;
use Module\index\view as moduleView;
use Engine\Helper as Helper;

/**
 *@file
 *
 *To accept parameters which are queryable and then inject into a fragment template
 *@return fragment.inc|| Data.
 */

class Load
{
    
    private $params;
    private $model;
    private $view;
    public $allowedKeys;

    

    /**
     *Initialise the object.
     *
     */
    public function __construct($param)
    {
        $this->params = $param;//need to determine allowed param keys in the module
        $this->allowedKeyedParams();
        $this->model = new model\model();
       // $this->model->_query($this->params);
    }

   
    /**
     *The data to send to view.
     *
     */
    public function _send()
    {
        $this->view = new moduleView\View('hello from index/load.php');//TODO Add data from model to be transformed
        $this->view->_send();

    }

    /**
     * Configuration method to allow access to modify database from a url parameter
     *
     *@todo Need a means of checking who is trying to make modification. 
     *      Global user class and Global admin class is needed. Possible by quering a database.
     *      This may be moved to a Global admin class, 
     *      so that the required module will recieve the applicable permissions
     *
     */
     private function configuration()
        {
            $this->allowedKeys = new \stdClass();
            $this->allowedKeys->qt = 'select'||'update'||'delete'; //allowed actions for this module query task
            $this->allowedKeys->tbl = 'user';//allowed tables access for this module
       
        }

    /**
     *Checks if the url is allowed to make requests based on the url parameters configured in confuguration method
     *@todo make the isset test more generic to be able to cope with other parameters.
     *@param 
     *@return Boolean
     */
    private function allowedKeyedParams()
    {   
        $this->configuration();
        
        //The WHERE and AND and LIMIT clause in the query will need to be handled seprately. 
        //So we must first remove them so that the allowed keys can valid.
        if(isset($this->params->weh))
        {
            $urlValueRemove = new Helper\Url();
            $paramObj =$urlValueRemove->unsetValue($this->params,'weh');
        }
        else
        {
            $paramObj = $this->params;
        }

        //Test if the url contains the allowed keys and values in the configuration method.
        if($paramObj==$this->allowedKeys)
            {
                return TRUE;
            }
            else
            {
                throw new \Exception('Not allowed to do this action. Please log in.');
            }
 
    }
}//END CLASS