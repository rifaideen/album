<?php

namespace humhub\modules\album\components;

use yii\web\UrlRuleInterface;
use yii\base\Object;

class UrlRule extends Object implements UrlRuleInterface
{
    
    public $connectionId = 'db';
    /**
     * Store already looked up usernames
     * 
     * @var Array
     */
    private static $loadedUserNamesByGuid = array();
    
    public function createUrl($manager, $route, $params)
    {
//        if (substr($route, 0, 5) == "album") {
//            return $route;
//        }
        return false;
    }
    
    public function parseRequest($manager, $request)
    {
        $pathInfo = $request->getPathInfo();
        
        return false;
    }
    /**
     * Looks up username by given user guid
     * 
     * @param String $guid of user
     * @return Username
     * @throws CException when user not found
     */
    public static function getUserNameByGuid($guid)
    {
        if (isset(self::$loadedUserNamesByGuid[$guid])) {
            return self::$loadedUserNamesByGuid[$guid];
        }
        $user = User::model()->resetScope()->findByAttributes(array('guid' => $guid));
        
        if ($user != null) {
            self::$loadedUserNamesByGuid[$guid] = $user->username;
            return self::$loadedUserNamesByGuid[$guid];
        } else {
            throw new CException("Could not find user by uguid!");
        }
        return "";
    }
}