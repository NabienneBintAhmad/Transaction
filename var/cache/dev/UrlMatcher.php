<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/_profiler' => [[['_route' => '_profiler_home', '_controller' => 'web_profiler.controller.profiler::homeAction'], null, null, null, true, false, null]],
        '/_profiler/search' => [[['_route' => '_profiler_search', '_controller' => 'web_profiler.controller.profiler::searchAction'], null, null, null, false, false, null]],
        '/_profiler/search_bar' => [[['_route' => '_profiler_search_bar', '_controller' => 'web_profiler.controller.profiler::searchBarAction'], null, null, null, false, false, null]],
        '/_profiler/phpinfo' => [[['_route' => '_profiler_phpinfo', '_controller' => 'web_profiler.controller.profiler::phpinfoAction'], null, null, null, false, false, null]],
        '/_profiler/open' => [[['_route' => '_profiler_open_file', '_controller' => 'web_profiler.controller.profiler::openAction'], null, null, null, false, false, null]],
        '/api/caissier' => [[['_route' => 'caisssier', '_controller' => 'App\\Controller\\CaissierController::new'], null, ['POST' => 0, 'GET' => 1], null, false, false, null]],
        '/api' => [
            [['_route' => 'prestataire_index', '_controller' => 'App\\Controller\\PrestataireController::index'], null, ['GET' => 0], null, true, false, null],
            [['_route' => 'user_prestataire_index', '_controller' => 'App\\Controller\\UserPrestataireController::index'], null, ['GET' => 0], null, true, false, null],
        ],
        '/transaction' => [[['_route' => 'transaction_index', '_controller' => 'App\\Controller\\TransactionController::index'], null, ['GET' => 0], null, true, false, null]],
        '/transaction/new' => [[['_route' => 'transaction_new', '_controller' => 'App\\Controller\\TransactionController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_(?'
                    .'|error/(\\d+)(?:\\.([^/]++))?(*:38)'
                    .'|wdt/([^/]++)(*:57)'
                    .'|profiler/([^/]++)(?'
                        .'|/(?'
                            .'|search/results(*:102)'
                            .'|router(*:116)'
                            .'|exception(?'
                                .'|(*:136)'
                                .'|\\.css(*:149)'
                            .')'
                        .')'
                        .'|(*:159)'
                    .')'
                .')'
                .'|/api(?'
                    .'|/(?'
                        .'|([^/]++)(?'
                            .'|(*:191)'
                            .'|/edit(*:204)'
                        .')'
                        .'|/([^/]++)(*:222)'
                        .'|j(*:231)'
                        .'|depot(*:244)'
                        .'|([^/]++)(?'
                            .'|(*:263)'
                            .'|/edit(*:276)'
                            .'|(*:284)'
                        .')'
                        .'|new(*:296)'
                        .'|([^/]++)(?'
                            .'|(*:315)'
                            .'|/edit(*:328)'
                            .'|(*:336)'
                        .')'
                        .'|co(?'
                            .'|ntrat(*:355)'
                            .'|mpt(?'
                                .'|(*:369)'
                                .'|etravail(*:385)'
                            .')'
                        .')'
                        .'|register(*:403)'
                        .'|bloquer(*:418)'
                        .'|debloquer(*:435)'
                        .'|login_check(*:454)'
                        .'|users(*:467)'
                        .'|([^/]++)(?'
                            .'|(*:486)'
                            .'|/edit(*:499)'
                            .'|(*:507)'
                        .')'
                    .')'
                    .'|(?:/(index)(?:\\.([^/]++))?)?(*:545)'
                    .'|/(?'
                        .'|d(?'
                            .'|oc(?'
                                .'|s(?:\\.([^/]++))?(*:582)'
                                .'|(*:590)'
                            .')'
                            .'|epots(?'
                                .'|(?:\\.([^/]++))?(?'
                                    .'|(*:625)'
                                .')'
                                .'|/([^/\\.]++)(?:\\.([^/]++))?(?'
                                    .'|(*:663)'
                                .')'
                            .')'
                        .')'
                        .'|c(?'
                            .'|o(?'
                                .'|ntexts/(.+)(?:\\.([^/]++))?(*:708)'
                                .'|mptes(?'
                                    .'|(?:\\.([^/]++))?(?'
                                        .'|(*:742)'
                                    .')'
                                    .'|/([^/\\.]++)(?:\\.([^/]++))?(?'
                                        .'|(*:780)'
                                    .')'
                                .')'
                            .')'
                            .'|aissiers(?'
                                .'|(?:\\.([^/]++))?(?'
                                    .'|(*:820)'
                                .')'
                                .'|/([^/\\.]++)(?:\\.([^/]++))?(?'
                                    .'|(*:858)'
                                .')'
                            .')'
                        .')'
                        .'|t(?'
                            .'|ransactions(?'
                                .'|(?:\\.([^/]++))?(?'
                                    .'|(*:905)'
                                .')'
                                .'|/([^/\\.]++)(?:\\.([^/]++))?(?'
                                    .'|(*:943)'
                                .')'
                            .')'
                            .'|arifs(?'
                                .'|(?:\\.([^/]++))?(?'
                                    .'|(*:979)'
                                .')'
                                .'|/([^/\\.]++)(?:\\.([^/]++))?(?'
                                    .'|(*:1017)'
                                .')'
                            .')'
                            .'|ype_transactions(?'
                                .'|(?:\\.([^/]++))?(?'
                                    .'|(*:1065)'
                                .')'
                                .'|/([^/\\.]++)(?:\\.([^/]++))?(?'
                                    .'|(*:1104)'
                                .')'
                            .')'
                        .')'
                        .'|user(?'
                            .'|_prestataires(?'
                                .'|(?:\\.([^/]++))?(?'
                                    .'|(*:1157)'
                                .')'
                                .'|/([^/\\.]++)(?:\\.([^/]++))?(?'
                                    .'|(*:1196)'
                                .')'
                            .')'
                            .'|s(?'
                                .'|(?:\\.([^/]++))?(?'
                                    .'|(*:1229)'
                                .')'
                                .'|/([^/\\.]++)(?:\\.([^/]++))?(?'
                                    .'|(*:1268)'
                                .')'
                            .')'
                        .')'
                        .'|images(?'
                            .'|(?:\\.([^/]++))?(?'
                                .'|(*:1307)'
                            .')'
                            .'|/([^/\\.]++)(?:\\.([^/]++))?(?'
                                .'|(*:1346)'
                            .')'
                        .')'
                        .'|admins(?'
                            .'|(?:\\.([^/]++))?(?'
                                .'|(*:1384)'
                            .')'
                            .'|/([^/\\.]++)(?:\\.([^/]++))?(?'
                                .'|(*:1423)'
                            .')'
                        .')'
                        .'|prestataires(?'
                            .'|(?:\\.([^/]++))?(?'
                                .'|(*:1467)'
                            .')'
                            .'|/([^/\\.]++)(?:\\.([^/]++))?(?'
                                .'|(*:1506)'
                            .')'
                        .')'
                        .'|login_check(*:1528)'
                    .')'
                .')'
                .'|/transaction/([^/]++)(?'
                    .'|(*:1563)'
                    .'|/edit(*:1577)'
                    .'|(*:1586)'
                .')'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        38 => [[['_route' => '_twig_error_test', '_controller' => 'twig.controller.preview_error::previewErrorPageAction', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        57 => [[['_route' => '_wdt', '_controller' => 'web_profiler.controller.profiler::toolbarAction'], ['token'], null, null, false, true, null]],
        102 => [[['_route' => '_profiler_search_results', '_controller' => 'web_profiler.controller.profiler::searchResultsAction'], ['token'], null, null, false, false, null]],
        116 => [[['_route' => '_profiler_router', '_controller' => 'web_profiler.controller.router::panelAction'], ['token'], null, null, false, false, null]],
        136 => [[['_route' => '_profiler_exception', '_controller' => 'web_profiler.controller.exception::showAction'], ['token'], null, null, false, false, null]],
        149 => [[['_route' => '_profiler_exception_css', '_controller' => 'web_profiler.controller.exception::cssAction'], ['token'], null, null, false, false, null]],
        159 => [[['_route' => '_profiler', '_controller' => 'web_profiler.controller.profiler::panelAction'], ['token'], null, null, false, true, null]],
        191 => [[['_route' => 'caissier_show', '_controller' => 'App\\Controller\\CaissierController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        204 => [[['_route' => 'caissier_edit', '_controller' => 'App\\Controller\\CaissierController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        222 => [[['_route' => 'caissier_delete', '_controller' => 'App\\Controller\\CaissierController::delete'], ['id'], ['DELETE' => 0], null, false, true, null]],
        231 => [[['_route' => 'depot_index', '_controller' => 'App\\Controller\\DepotController::index'], [], ['GET' => 0], null, false, false, null]],
        244 => [[['_route' => 'depot', '_controller' => 'App\\Controller\\DepotController::new'], [], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        263 => [[['_route' => 'depot_show', '_controller' => 'App\\Controller\\DepotController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        276 => [[['_route' => 'depot_edit', '_controller' => 'App\\Controller\\DepotController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        284 => [[['_route' => 'depot_delete', '_controller' => 'App\\Controller\\DepotController::delete'], ['id'], ['DELETE' => 0], null, false, true, null]],
        296 => [[['_route' => 'prestataire_new', '_controller' => 'App\\Controller\\PrestataireController::new'], [], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        315 => [[['_route' => 'prestataire_show', '_controller' => 'App\\Controller\\PrestataireController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        328 => [[['_route' => 'prestataire_edit', '_controller' => 'App\\Controller\\PrestataireController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        336 => [[['_route' => 'prestataire_delete', '_controller' => 'App\\Controller\\PrestataireController::delete'], ['id'], ['DELETE' => 0], null, false, true, null]],
        355 => [[['_route' => 'prestataire_contrat', '_controller' => 'App\\Controller\\PrestataireController::contrat'], [], ['GET' => 0], null, false, false, null]],
        369 => [[['_route' => 'compt', '_controller' => 'App\\Controller\\SecurityController::compte'], [], ['POST' => 0], null, false, false, null]],
        385 => [[['_route' => 'comptetravail', '_controller' => 'App\\Controller\\UserPrestataireController::comptetravail'], [], ['POST' => 0], null, false, false, null]],
        403 => [[['_route' => 'register', '_controller' => 'App\\Controller\\SecurityController::register'], [], ['POST' => 0], null, false, false, null]],
        418 => [[['_route' => 'bloquer', '_controller' => 'App\\Controller\\SecurityController::bloquer'], [], ['POST' => 0], null, false, false, null]],
        435 => [[['_route' => 'debloquer', '_controller' => 'App\\Controller\\SecurityController::debloquer'], [], ['POST' => 0], null, false, false, null]],
        454 => [[['_route' => 'login', '_controller' => 'App\\Controller\\SecurityController::login'], [], ['POST' => 0], null, false, false, null]],
        467 => [[['_route' => 'user_prestataire_new', '_controller' => 'App\\Controller\\UserPrestataireController::new'], [], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        486 => [[['_route' => 'user_prestataire_show', '_controller' => 'App\\Controller\\UserPrestataireController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        499 => [[['_route' => 'user_prestataire_edit', '_controller' => 'App\\Controller\\UserPrestataireController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        507 => [[['_route' => 'user_prestataire_delete', '_controller' => 'App\\Controller\\UserPrestataireController::delete'], ['id'], ['DELETE' => 0], null, false, true, null]],
        545 => [[['_route' => 'api_entrypoint', '_controller' => 'api_platform.action.entrypoint', '_format' => '', '_api_respond' => 'true', 'index' => 'index'], ['index', '_format'], null, null, false, true, null]],
        582 => [[['_route' => 'api_doc', '_controller' => 'api_platform.action.documentation', '_format' => '', '_api_respond' => 'true'], ['_format'], null, null, false, true, null]],
        590 => [[['_route' => 'app.swagger_ui', '_controller' => 'nelmio_api_doc.controller.swagger_ui'], [], ['GET' => 0], null, false, false, null]],
        625 => [
            [['_route' => 'api_depots_get_collection', '_controller' => 'api_platform.action.get_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Depot', '_api_collection_operation_name' => 'get'], ['_format'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api_depots_post_collection', '_controller' => 'api_platform.action.post_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Depot', '_api_collection_operation_name' => 'post'], ['_format'], ['POST' => 0], null, false, true, null],
        ],
        663 => [
            [['_route' => 'api_depots_get_item', '_controller' => 'api_platform.action.get_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Depot', '_api_item_operation_name' => 'get'], ['id', '_format'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api_depots_delete_item', '_controller' => 'api_platform.action.delete_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Depot', '_api_item_operation_name' => 'delete'], ['id', '_format'], ['DELETE' => 0], null, false, true, null],
            [['_route' => 'api_depots_put_item', '_controller' => 'api_platform.action.put_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Depot', '_api_item_operation_name' => 'put'], ['id', '_format'], ['PUT' => 0], null, false, true, null],
        ],
        708 => [[['_route' => 'api_jsonld_context', '_controller' => 'api_platform.jsonld.action.context', '_format' => 'jsonld', '_api_respond' => 'true'], ['shortName', '_format'], null, null, false, true, null]],
        742 => [
            [['_route' => 'api_comptes_get_collection', '_controller' => 'api_platform.action.get_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Compte', '_api_collection_operation_name' => 'get'], ['_format'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api_comptes_post_collection', '_controller' => 'api_platform.action.post_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Compte', '_api_collection_operation_name' => 'post'], ['_format'], ['POST' => 0], null, false, true, null],
        ],
        780 => [
            [['_route' => 'api_comptes_get_item', '_controller' => 'api_platform.action.get_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Compte', '_api_item_operation_name' => 'get'], ['id', '_format'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api_comptes_delete_item', '_controller' => 'api_platform.action.delete_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Compte', '_api_item_operation_name' => 'delete'], ['id', '_format'], ['DELETE' => 0], null, false, true, null],
            [['_route' => 'api_comptes_put_item', '_controller' => 'api_platform.action.put_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Compte', '_api_item_operation_name' => 'put'], ['id', '_format'], ['PUT' => 0], null, false, true, null],
        ],
        820 => [
            [['_route' => 'api_caissiers_get_collection', '_controller' => 'api_platform.action.get_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Caissier', '_api_collection_operation_name' => 'get'], ['_format'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api_caissiers_post_collection', '_controller' => 'api_platform.action.post_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Caissier', '_api_collection_operation_name' => 'post'], ['_format'], ['POST' => 0], null, false, true, null],
        ],
        858 => [
            [['_route' => 'api_caissiers_get_item', '_controller' => 'api_platform.action.get_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Caissier', '_api_item_operation_name' => 'get'], ['id', '_format'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api_caissiers_delete_item', '_controller' => 'api_platform.action.delete_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Caissier', '_api_item_operation_name' => 'delete'], ['id', '_format'], ['DELETE' => 0], null, false, true, null],
            [['_route' => 'api_caissiers_put_item', '_controller' => 'api_platform.action.put_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Caissier', '_api_item_operation_name' => 'put'], ['id', '_format'], ['PUT' => 0], null, false, true, null],
        ],
        905 => [
            [['_route' => 'api_transactions_get_collection', '_controller' => 'api_platform.action.get_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Transaction', '_api_collection_operation_name' => 'get'], ['_format'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api_transactions_post_collection', '_controller' => 'api_platform.action.post_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Transaction', '_api_collection_operation_name' => 'post'], ['_format'], ['POST' => 0], null, false, true, null],
        ],
        943 => [
            [['_route' => 'api_transactions_get_item', '_controller' => 'api_platform.action.get_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Transaction', '_api_item_operation_name' => 'get'], ['id', '_format'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api_transactions_delete_item', '_controller' => 'api_platform.action.delete_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Transaction', '_api_item_operation_name' => 'delete'], ['id', '_format'], ['DELETE' => 0], null, false, true, null],
            [['_route' => 'api_transactions_put_item', '_controller' => 'api_platform.action.put_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Transaction', '_api_item_operation_name' => 'put'], ['id', '_format'], ['PUT' => 0], null, false, true, null],
        ],
        979 => [
            [['_route' => 'api_tarifs_get_collection', '_controller' => 'api_platform.action.get_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Tarif', '_api_collection_operation_name' => 'get'], ['_format'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api_tarifs_post_collection', '_controller' => 'api_platform.action.post_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Tarif', '_api_collection_operation_name' => 'post'], ['_format'], ['POST' => 0], null, false, true, null],
        ],
        1017 => [
            [['_route' => 'api_tarifs_get_item', '_controller' => 'api_platform.action.get_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Tarif', '_api_item_operation_name' => 'get'], ['id', '_format'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api_tarifs_delete_item', '_controller' => 'api_platform.action.delete_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Tarif', '_api_item_operation_name' => 'delete'], ['id', '_format'], ['DELETE' => 0], null, false, true, null],
            [['_route' => 'api_tarifs_put_item', '_controller' => 'api_platform.action.put_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Tarif', '_api_item_operation_name' => 'put'], ['id', '_format'], ['PUT' => 0], null, false, true, null],
        ],
        1065 => [
            [['_route' => 'api_type_transactions_get_collection', '_controller' => 'api_platform.action.get_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\TypeTransaction', '_api_collection_operation_name' => 'get'], ['_format'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api_type_transactions_post_collection', '_controller' => 'api_platform.action.post_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\TypeTransaction', '_api_collection_operation_name' => 'post'], ['_format'], ['POST' => 0], null, false, true, null],
        ],
        1104 => [
            [['_route' => 'api_type_transactions_get_item', '_controller' => 'api_platform.action.get_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\TypeTransaction', '_api_item_operation_name' => 'get'], ['id', '_format'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api_type_transactions_delete_item', '_controller' => 'api_platform.action.delete_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\TypeTransaction', '_api_item_operation_name' => 'delete'], ['id', '_format'], ['DELETE' => 0], null, false, true, null],
            [['_route' => 'api_type_transactions_put_item', '_controller' => 'api_platform.action.put_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\TypeTransaction', '_api_item_operation_name' => 'put'], ['id', '_format'], ['PUT' => 0], null, false, true, null],
        ],
        1157 => [
            [['_route' => 'api_user_prestataires_get_collection', '_controller' => 'api_platform.action.get_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\UserPrestataire', '_api_collection_operation_name' => 'get'], ['_format'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api_user_prestataires_post_collection', '_controller' => 'api_platform.action.post_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\UserPrestataire', '_api_collection_operation_name' => 'post'], ['_format'], ['POST' => 0], null, false, true, null],
        ],
        1196 => [
            [['_route' => 'api_user_prestataires_get_item', '_controller' => 'api_platform.action.get_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\UserPrestataire', '_api_item_operation_name' => 'get'], ['id', '_format'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api_user_prestataires_delete_item', '_controller' => 'api_platform.action.delete_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\UserPrestataire', '_api_item_operation_name' => 'delete'], ['id', '_format'], ['DELETE' => 0], null, false, true, null],
            [['_route' => 'api_user_prestataires_put_item', '_controller' => 'api_platform.action.put_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\UserPrestataire', '_api_item_operation_name' => 'put'], ['id', '_format'], ['PUT' => 0], null, false, true, null],
        ],
        1229 => [
            [['_route' => 'api_users_get_collection', '_controller' => 'api_platform.action.get_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\User', '_api_collection_operation_name' => 'get'], ['_format'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api_users_post_collection', '_controller' => 'api_platform.action.post_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\User', '_api_collection_operation_name' => 'post'], ['_format'], ['POST' => 0], null, false, true, null],
        ],
        1268 => [
            [['_route' => 'api_users_get_item', '_controller' => 'api_platform.action.get_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\User', '_api_item_operation_name' => 'get'], ['id', '_format'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api_users_delete_item', '_controller' => 'api_platform.action.delete_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\User', '_api_item_operation_name' => 'delete'], ['id', '_format'], ['DELETE' => 0], null, false, true, null],
            [['_route' => 'api_users_put_item', '_controller' => 'api_platform.action.put_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\User', '_api_item_operation_name' => 'put'], ['id', '_format'], ['PUT' => 0], null, false, true, null],
        ],
        1307 => [
            [['_route' => 'api_images_get_collection', '_controller' => 'api_platform.action.get_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Image', '_api_collection_operation_name' => 'get'], ['_format'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api_images_post_collection', '_controller' => 'api_platform.action.post_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Image', '_api_collection_operation_name' => 'post'], ['_format'], ['POST' => 0], null, false, true, null],
        ],
        1346 => [
            [['_route' => 'api_images_get_item', '_controller' => 'api_platform.action.get_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Image', '_api_item_operation_name' => 'get'], ['id', '_format'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api_images_delete_item', '_controller' => 'api_platform.action.delete_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Image', '_api_item_operation_name' => 'delete'], ['id', '_format'], ['DELETE' => 0], null, false, true, null],
            [['_route' => 'api_images_put_item', '_controller' => 'api_platform.action.put_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Image', '_api_item_operation_name' => 'put'], ['id', '_format'], ['PUT' => 0], null, false, true, null],
        ],
        1384 => [
            [['_route' => 'api_admins_get_collection', '_controller' => 'api_platform.action.get_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Admin', '_api_collection_operation_name' => 'get'], ['_format'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api_admins_post_collection', '_controller' => 'api_platform.action.post_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Admin', '_api_collection_operation_name' => 'post'], ['_format'], ['POST' => 0], null, false, true, null],
        ],
        1423 => [
            [['_route' => 'api_admins_get_item', '_controller' => 'api_platform.action.get_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Admin', '_api_item_operation_name' => 'get'], ['id', '_format'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api_admins_delete_item', '_controller' => 'api_platform.action.delete_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Admin', '_api_item_operation_name' => 'delete'], ['id', '_format'], ['DELETE' => 0], null, false, true, null],
            [['_route' => 'api_admins_put_item', '_controller' => 'api_platform.action.put_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Admin', '_api_item_operation_name' => 'put'], ['id', '_format'], ['PUT' => 0], null, false, true, null],
        ],
        1467 => [
            [['_route' => 'api_prestataires_get_collection', '_controller' => 'api_platform.action.get_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Prestataire', '_api_collection_operation_name' => 'get'], ['_format'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api_prestataires_post_collection', '_controller' => 'api_platform.action.post_collection', '_format' => null, '_api_resource_class' => 'App\\Entity\\Prestataire', '_api_collection_operation_name' => 'post'], ['_format'], ['POST' => 0], null, false, true, null],
        ],
        1506 => [
            [['_route' => 'api_prestataires_get_item', '_controller' => 'api_platform.action.get_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Prestataire', '_api_item_operation_name' => 'get'], ['id', '_format'], ['GET' => 0], null, false, true, null],
            [['_route' => 'api_prestataires_delete_item', '_controller' => 'api_platform.action.delete_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Prestataire', '_api_item_operation_name' => 'delete'], ['id', '_format'], ['DELETE' => 0], null, false, true, null],
            [['_route' => 'api_prestataires_put_item', '_controller' => 'api_platform.action.put_item', '_format' => null, '_api_resource_class' => 'App\\Entity\\Prestataire', '_api_item_operation_name' => 'put'], ['id', '_format'], ['PUT' => 0], null, false, true, null],
        ],
        1528 => [[['_route' => 'api_login_check'], [], null, null, false, false, null]],
        1563 => [[['_route' => 'transaction_show', '_controller' => 'App\\Controller\\TransactionController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        1577 => [[['_route' => 'transaction_edit', '_controller' => 'App\\Controller\\TransactionController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        1586 => [
            [['_route' => 'transaction_delete', '_controller' => 'App\\Controller\\TransactionController::delete'], ['id'], ['DELETE' => 0], null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
