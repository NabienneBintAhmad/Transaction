<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/api/caissier' => [[['_route' => 'caissier_new', '_controller' => 'App\\Controller\\CaissierController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/api' => [
            [['_route' => 'depot_index', '_controller' => 'App\\Controller\\DepotController::index'], null, ['GET' => 0], null, true, false, null],
            [['_route' => 'user_prestataire_index', '_controller' => 'App\\Controller\\UserPrestataireController::index'], null, ['GET' => 0], null, true, false, null],
        ],
        '/image' => [[['_route' => 'image_index', '_controller' => 'App\\Controller\\ImageController::index'], null, ['GET' => 0], null, true, false, null]],
        '/image/new' => [[['_route' => 'image_new', '_controller' => 'App\\Controller\\ImageController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/api/register/bloquer' => [[['_route' => 'bloquer', '_controller' => 'App\\Controller\\SecurityController::bloquer'], null, ['POST' => 0, 'GET' => 1], null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/api(?'
                    .'|/(?'
                        .'|([^/]++)(?'
                            .'|(*:29)'
                            .'|/edit(*:41)'
                            .'|(*:48)'
                        .')'
                        .'|depot(*:61)'
                        .'|([^/]++)(?'
                            .'|(*:79)'
                            .'|/edit(*:91)'
                            .'|(*:98)'
                        .')'
                        .'|register(*:114)'
                        .'|login(*:127)'
                        .'|users(*:140)'
                        .'|([^/]++)(?'
                            .'|(*:159)'
                            .'|/edit(*:172)'
                            .'|(*:180)'
                        .')'
                    .')'
                    .'|(?:/(index)(?:\\.([^/]++))?)?(*:218)'
                    .'|/(?'
                        .'|d(?'
                            .'|oc(?'
                                .'|s(?:\\.([^/]++))?(*:255)'
                                .'|(*:263)'
                            .')'
                            .'|epots(?'
                                .'|(?:\\.([^/]++))?(?'
                                    .'|(*:298)'
                                .')'
                                .'|/([^/\\.]++)(?:\\.([^/]++))?(?'
                                    .'|(*:336)'
                                .')'
                            .')'
                        .')'
                        .'|c(?'
                            .'|o(?'
                                .'|ntexts/(.+)(?:\\.([^/]++))?(*:381)'
                                .'|mptes(?'
                                    .'|(?:\\.([^/]++))?(?'
                                        .'|(*:415)'
                                    .')'
                                    .'|/([^/\\.]++)(?:\\.([^/]++))?(?'
                                        .'|(*:453)'
                                    .')'
                                .')'
                            .')'
                            .'|aissiers(?'
                                .'|(?:\\.([^/]++))?(?'
                                    .'|(*:493)'
                                .')'
                                .'|/([^/\\.]++)(?:\\.([^/]++))?(?'
                                    .'|(*:531)'
                                .')'
                            .')'
                        .')'
                        .'|user_prestataires(?'
                            .'|(?:\\.([^/]++))?(?'
                                .'|(*:580)'
                            .')'
                            .'|/([^/\\.]++)(?:\\.([^/]++))?(?'
                                .'|(*:618)'
                            .')'
                        .')'
                        .'|images(?'
                            .'|(?:\\.([^/]++))?(?'
                                .'|(*:655)'
                            .')'
                            .'|/([^/\\.]++)(?:\\.([^/]++))?(?'
                                .'|(*:693)'
                            .')'
                        .')'
                        .'|admins(?'
                            .'|(?:\\.([^/]++))?(?'
                                .'|(*:730)'
                            .')'
                            .'|/([^/\\.]++)(?:\\.([^/]++))?(?'
                                .'|(*:768)'
                            .')'
                        .')'
                        .'|prestataires(?'
                            .'|(?:\\.([^/]++))?(?'
                                .'|(*:811)'
                            .')'
                            .'|/([^/\\.]++)(?:\\.([^/]++))?(?'
                                .'|(*:849)'
                            .')'
                        .')'
                        .'|login_check(*:870)'
                    .')'
                .')'
                .'|/image/([^/]++)(?'
                    .'|(*:898)'
                    .'|/edit(*:911)'
                    .'|(*:919)'
                .')'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        29 => [[['_route' => 'caissier_show', '_controller' => 'App\\Controller\\CaissierController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        41 => [[['_route' => 'caissier_edit', '_controller' => 'App\\Controller\\CaissierController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        48 => [[['_route' => 'caissier_delete', '_controller' => 'App\\Controller\\CaissierController::delete'], ['id'], ['DELETE' => 0], null, false, true, null]],
        61 => [[['_route' => 'depot', '_controller' => 'App\\Controller\\DepotController::new'], [], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        79 => [[['_route' => 'depot_show', '_controller' => 'App\\Controller\\DepotController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        91 => [[['_route' => 'depot_edit', '_controller' => 'App\\Controller\\DepotController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        98 => [[['_route' => 'depot_delete', '_controller' => 'App\\Controller\\DepotController::delete'], ['id'], ['DELETE' => 0], null, false, true, null]],
        114 => [[['_route' => 'register', '_controller' => 'App\\Controller\\SecurityController::register'], [], ['POST' => 0], null, false, false, null]],
        127 => [[['_route' => 'login', '_controller' => 'App\\Controller\\SecurityController::login'], [], ['POST' => 0], null, false, false, null]],
        140 => [[['_route' => 'user_prestataire_new', '_controller' => 'App\\Controller\\UserPrestataireController::new'], [], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        159 => [[['_route' => 'user_prestataire_show', '_controller' => 'App\\Controller\\UserPrestataireController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        172 => [[['_route' => 'user_prestataire_edit', '_controller' => 'App\\Controller\\UserPrestataireController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        180 => [[['_route' => 'user_prestataire_delete', '_controller' => 'App\\Controller\\UserPrestataireController::delete'], ['id'], ['DELETE' => 0], null, false, true, null]],
        218 => [[['_route' => 'api_entrypoint', '_controller' => 'api_platform.action.entrypoint', '_format' => '', '_api_respond' => 'true', 'index' => 'index'], ['index', '_format'], null, null, false, true, null]],
        255 => [[['_route' => 'api_doc', '_controller' => 'api_platform.action.documentation', '_format' => '', '_api_respond' => 'true'], ['_format'], null, null, false, true, null]],
        263 => [[['_route' => 'app.swagger_ui', '_controller' => 'nelmio_api_doc.controller.swagger_ui'], [], ['GET' => 0], null, false, false, null]],
        298 => [
            [['_route' => 'api_depots_get_collection', '_controller' => 'api_platform.action.get_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Depot', '_api_collection_operation_name' => 'get'], ['_format'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api_depots_post_collection', '_controller' => 'api_platform.action.post_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Depot', '_api_collection_operation_name' => 'post'], ['_format'], ['POST' => 0], null, false, true, null],
        ],
        336 => [
            [['_route' => 'api_depots_get_item', '_controller' => 'api_platform.action.get_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Depot', '_api_item_operation_name' => 'get'], ['id', '_format'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api_depots_delete_item', '_controller' => 'api_platform.action.delete_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Depot', '_api_item_operation_name' => 'delete'], ['id', '_format'], ['DELETE' => 0], null, false, true, null],
            [['_route' => 'api_depots_put_item', '_controller' => 'api_platform.action.put_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Depot', '_api_item_operation_name' => 'put'], ['id', '_format'], ['PUT' => 0], null, false, true, null],
        ],
        381 => [[['_route' => 'api_jsonld_context', '_controller' => 'api_platform.jsonld.action.context', '_format' => 'jsonld', '_api_respond' => 'true'], ['shortName', '_format'], null, null, false, true, null]],
        415 => [
            [['_route' => 'api_comptes_get_collection', '_controller' => 'api_platform.action.get_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Compte', '_api_collection_operation_name' => 'get'], ['_format'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api_comptes_post_collection', '_controller' => 'api_platform.action.post_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Compte', '_api_collection_operation_name' => 'post'], ['_format'], ['POST' => 0], null, false, true, null],
        ],
        453 => [
            [['_route' => 'api_comptes_get_item', '_controller' => 'api_platform.action.get_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Compte', '_api_item_operation_name' => 'get'], ['id', '_format'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api_comptes_delete_item', '_controller' => 'api_platform.action.delete_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Compte', '_api_item_operation_name' => 'delete'], ['id', '_format'], ['DELETE' => 0], null, false, true, null],
            [['_route' => 'api_comptes_put_item', '_controller' => 'api_platform.action.put_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Compte', '_api_item_operation_name' => 'put'], ['id', '_format'], ['PUT' => 0], null, false, true, null],
        ],
        493 => [
            [['_route' => 'api_caissiers_get_collection', '_controller' => 'api_platform.action.get_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Caissier', '_api_collection_operation_name' => 'get'], ['_format'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api_caissiers_post_collection', '_controller' => 'api_platform.action.post_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Caissier', '_api_collection_operation_name' => 'post'], ['_format'], ['POST' => 0], null, false, true, null],
        ],
        531 => [
            [['_route' => 'api_caissiers_get_item', '_controller' => 'api_platform.action.get_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Caissier', '_api_item_operation_name' => 'get'], ['id', '_format'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api_caissiers_delete_item', '_controller' => 'api_platform.action.delete_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Caissier', '_api_item_operation_name' => 'delete'], ['id', '_format'], ['DELETE' => 0], null, false, true, null],
            [['_route' => 'api_caissiers_put_item', '_controller' => 'api_platform.action.put_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Caissier', '_api_item_operation_name' => 'put'], ['id', '_format'], ['PUT' => 0], null, false, true, null],
        ],
        580 => [
            [['_route' => 'api_user_prestataires_get_collection', '_controller' => 'api_platform.action.get_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\UserPrestataire', '_api_collection_operation_name' => 'get'], ['_format'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api_user_prestataires_post_collection', '_controller' => 'api_platform.action.post_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\UserPrestataire', '_api_collection_operation_name' => 'post'], ['_format'], ['POST' => 0], null, false, true, null],
        ],
        618 => [
            [['_route' => 'api_user_prestataires_get_item', '_controller' => 'api_platform.action.get_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\UserPrestataire', '_api_item_operation_name' => 'get'], ['id', '_format'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api_user_prestataires_delete_item', '_controller' => 'api_platform.action.delete_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\UserPrestataire', '_api_item_operation_name' => 'delete'], ['id', '_format'], ['DELETE' => 0], null, false, true, null],
            [['_route' => 'api_user_prestataires_put_item', '_controller' => 'api_platform.action.put_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\UserPrestataire', '_api_item_operation_name' => 'put'], ['id', '_format'], ['PUT' => 0], null, false, true, null],
        ],
        655 => [
            [['_route' => 'api_images_get_collection', '_controller' => 'api_platform.action.get_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Image', '_api_collection_operation_name' => 'get'], ['_format'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api_images_post_collection', '_controller' => 'api_platform.action.post_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Image', '_api_collection_operation_name' => 'post'], ['_format'], ['POST' => 0], null, false, true, null],
        ],
        693 => [
            [['_route' => 'api_images_get_item', '_controller' => 'api_platform.action.get_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Image', '_api_item_operation_name' => 'get'], ['id', '_format'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api_images_delete_item', '_controller' => 'api_platform.action.delete_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Image', '_api_item_operation_name' => 'delete'], ['id', '_format'], ['DELETE' => 0], null, false, true, null],
            [['_route' => 'api_images_put_item', '_controller' => 'api_platform.action.put_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Image', '_api_item_operation_name' => 'put'], ['id', '_format'], ['PUT' => 0], null, false, true, null],
        ],
        730 => [
            [['_route' => 'api_admins_get_collection', '_controller' => 'api_platform.action.get_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Admin', '_api_collection_operation_name' => 'get'], ['_format'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api_admins_post_collection', '_controller' => 'api_platform.action.post_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Admin', '_api_collection_operation_name' => 'post'], ['_format'], ['POST' => 0], null, false, true, null],
        ],
        768 => [
            [['_route' => 'api_admins_get_item', '_controller' => 'api_platform.action.get_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Admin', '_api_item_operation_name' => 'get'], ['id', '_format'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api_admins_delete_item', '_controller' => 'api_platform.action.delete_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Admin', '_api_item_operation_name' => 'delete'], ['id', '_format'], ['DELETE' => 0], null, false, true, null],
            [['_route' => 'api_admins_put_item', '_controller' => 'api_platform.action.put_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Admin', '_api_item_operation_name' => 'put'], ['id', '_format'], ['PUT' => 0], null, false, true, null],
        ],
        811 => [
            [['_route' => 'api_prestataires_get_collection', '_controller' => 'api_platform.action.get_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Prestataire', '_api_collection_operation_name' => 'get'], ['_format'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api_prestataires_post_collection', '_controller' => 'api_platform.action.post_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Prestataire', '_api_collection_operation_name' => 'post'], ['_format'], ['POST' => 0], null, false, true, null],
        ],
        849 => [
            [['_route' => 'api_prestataires_get_item', '_controller' => 'api_platform.action.get_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Prestataire', '_api_item_operation_name' => 'get'], ['id', '_format'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api_prestataires_delete_item', '_controller' => 'api_platform.action.delete_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Prestataire', '_api_item_operation_name' => 'delete'], ['id', '_format'], ['DELETE' => 0], null, false, true, null],
            [['_route' => 'api_prestataires_put_item', '_controller' => 'api_platform.action.put_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Prestataire', '_api_item_operation_name' => 'put'], ['id', '_format'], ['PUT' => 0], null, false, true, null],
        ],
        870 => [[['_route' => 'api_login_check'], [], null, null, false, false, null]],
        898 => [[['_route' => 'image_show', '_controller' => 'App\\Controller\\ImageController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        911 => [[['_route' => 'image_edit', '_controller' => 'App\\Controller\\ImageController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        919 => [
            [['_route' => 'image_delete', '_controller' => 'App\\Controller\\ImageController::delete'], ['id'], ['DELETE' => 0], null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
