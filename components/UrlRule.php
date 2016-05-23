<?php

namespace humhub\modules\album\components;

use yii\web\UrlRuleInterface;
use yii\base\Object;
use humhub\modules\user\models\User;

/**
 * Album URL Rules
 *
 * @author Rifaudeen <rifajas@gmail.com>
 */
class UrlRule extends Object implements UrlRuleInterface
{

    /**
     * @inheritdoc
     */
    public function createUrl($manager, $route, $params)
    {
        /**
         * @todo Handle Url management for get format.
         */
        $format = 'path';

        if (isset($params['username'],$params['id']) && substr($route, 0, 5) == "album") {
            if ($format == 'path') {
                $userName = $params['username'];
                $url = urlencode(strtolower($userName)) . "/" . $route . "/" . $params['id'];
                return $url;
            } else {
                unset($params['username']);
                return count($params) > 0 ?
                '?' . $manager->routeVar . '=' . $route . $ampersand . $manager->createPathInfo($params, '=', $ampersand)
                    :
                '?' . $manager->routeVar . '=' . $route;
            }

        } elseif (isset($params['username']) && substr($route, 0, 5) == "album") {
            if ($format == 'path') {
                $userName = $params['username'];
                $url = urlencode(strtolower($userName)) . "/" . $route;
                return $url;
            } else {
                unset($params['username']);
                return count($params) > 0 ?
                '?' . $manager->routeVar . '=' . $route . $ampersand . $manager->createPathInfo($params, '=', $ampersand)
                    :
                '?' . $manager->routeVar . '=' . $route;
            }
        }

        return false;
    }

    /**
     * @inheritdoc
     */
    public function parseRequest($manager, $request)
    {
        $pathInfo = $request->getPathInfo();
        $parts = explode('/', $pathInfo, 3);
        /**
         * $parts[0] username from $pathInfo
         * $parts[1] album from $pathInfo
         * $parts[2] rest of $pathInfo
         */
        if (isset($parts[1]) && $parts[1] == 'album') {

            $user = User::findOne(['username' => $parts[0]]);

            if ($user !== null) {
                $params = $request->get();
                $params['uguid'] = $user->guid;
                $params['username'] = $user->username;

                if (!isset($parts[2])) {
                    return $parts[1];
                }

                $parts = explode('/',$parts[2]);
                $total_parts = count($parts);

                if ($total_parts == 3) {
                    /**
                     * $part[0] controller
                     * $part[1] action
                     * $part[2] id
                     */
                    $params['id'] = $parts[2];
                    return ['album/'. $parts[0] . '/'. $parts[1], $params];
                } elseif ($total_parts == 2) {
                    if (ctype_digit($parts[1])) {
                       /**
                        * $part[0] controller
                        * $part[1] id
                        */
                       $params['id'] = $parts[1];
                       return ['album/'. $parts[0], $params];
                    } else {
                       /**
                        * $part[0] controller
                        * $part[1] action
                        */
                       return ['album/'. $parts[0] .'/'.$parts[1], $params];
                    }

                } elseif ($total_parts == 1) {
                    /**
                     * $part[0] action
                     */
                    return ['album/' . $parts[0], $params];
                }
            }
        }
        return false;
    }
}
