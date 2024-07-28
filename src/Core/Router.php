<?php
namespace Apps\Core;

use Apps\App\Controller\ErrorController;
use ReflectionClass;
use ReflectionException;
use ReflectionParameter;
use SessionIdInterface;


class Router {
    public static $routes = [];

    public static function get($uri, $controllerAction) {
        self::$routes['GET'][$uri] = $controllerAction;
    }

    public static function post($uri, $controllerAction) {
        self::$routes['POST'][$uri] = $controllerAction;
    }

    public static function separate() {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = trim($_SERVER['REQUEST_URI'], '/');
        
        if (isset(self::$routes[$method][$uri])) {
            $route = self::$routes[$method][$uri];
            
            if (is_array($route) && isset($route['controller']) && isset($route['action'])) {
                $controllerClass = "Apps\\App\\Controller\\{$route['controller']}";
                $action = $route['action'];
                
                try {
                    // Vérifier l'existence de la classe avec Reflection
                    $reflector = new ReflectionClass($controllerClass);
                    
                    // Vérifier l'existence de la méthode dans la classe avec Reflection
                    if ($reflector->hasMethod($action)) {
                        $constructor = $reflector->getConstructor();
                        $params = [];
                        
                        if ($constructor) {
                            $constructorParams = $constructor->getParameters();
                            foreach ($constructorParams as $param) {
                                $paramType = $param->getType();
                                if ($paramType && !$paramType->isBuiltin()) {
                                    $paramClass = new ReflectionClass($paramType->getName());
                                    if  ( $paramClass->implementsInterface(SessionInterface::class))  {
                                        $params[] = ProviderServices::getInstance()->getSession();
                                    } else {
                                        $params[] = null; 
                                    }
                                } else {
                                    $params[] = null; 
                                }
                            }
                        }

                        // Créer une instance du contrôleur avec les paramètres injectés
                        $controller = $reflector->newInstanceArgs($params);
                        $method = $reflector->getMethod($action);
                        
                        if ($method->isPublic()) {
                            $method->invoke($controller);
                        } else {
                            echo "L'action '{$action}' n'est pas accessible dans le contrôleur '{$controllerClass}'.";
                        }
                    } else {
                        echo "L'action '{$action}' n'existe pas dans le contrôleur '{$controllerClass}'.";
                    }
                } catch (ReflectionException $e) {
                    echo "Le contrôleur '{$controllerClass}' n'existe pas.";
                }
            } else {
                echo 'Format de route invalide.';
            }
        } else {
            self::handleError();
        }
    }

    private static function handleError()
    {
        $errorController = new ErrorController();
        $errorController->Error_404();
    }
}






























// class Router
// {
//     private static $routes = [];

//     public function __construct(array $routes = [])
//     {
//         self::$routes = $routes;
//     }

//     public static function __callStatic($method, $args)
//     {
//         if (in_array(strtoupper($method), ['GET', 'POST'])) {
//             self::addRoute(strtoupper($method), $args[0], $args[1], $args[2]);
//         }
//     }

//     private static function addRoute($method, $path, $controller, $action)
//     {
//         self::$routes[$path] = [
//             'method' => $method,
//             'controller' => $controller,
//             'action' => $action
//         ];
//     }

//     public static function create(string $uri, string $method)
//     {
//         foreach (self::$routes as $route => $config) {
//             // Convertir la route en regex pour gérer les paramètres dynamiques
//             $regex = '#^' . preg_replace('/\{[a-zA-Z0-9_]+\}/', '([a-zA-Z0-9_]+)', str_replace('/', '\/', $route)) . '$#';
//             if (preg_match($regex, $uri, $matches) && $config['method'] === $method) {
//                 array_shift($matches); // Supprimer le premier élément qui est l'URL complète
//                 $controllerName = $config['controller'];
//                 $action = $config['action'];
//                 $controllerClass = 'Apps\\App\\Controller\\' . ucfirst($controllerName);
                
//                 try {
//                     $reflectionClass = new ReflectionClass($controllerClass);
//                     $controllerInstance = $reflectionClass->newInstance();
//                     $reflectionMethod = $reflectionClass->getMethod($action);
//                     $reflectionMethod->invokeArgs($controllerInstance, $matches);
//                     return;
//                 } catch (ReflectionException $e) {
//                     self::handleError();
//                     return;
//                 }
//             }
//         }
//         self::handleError();
//     }

//     private static function handleError()
//     {
//         $errorController = new ErrorController();
//         $errorController->Error_404();
//     }
// }







