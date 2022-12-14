<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="assets/file-explore.css" rel="stylesheet">

</head>

<body>
    <?php include_once 'geshi/geshi.php'; ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h1>
                        What You Should Do After Download
                    </h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">

                <p>
                    Frist of all you should know this file is not plugin or excutable file BUT it could be make your
                    Life simple as a wordpress developer.
                </p>
                <p><strong>Your Downloaded file coulde be a one of your View in your plugin it is CRUD based on your
                        Project</strong><br />
                    frist of all make your admin menu in your project as example imagin your proget-name is ``shopping``
                </p>
                <p> so we need to creat folder in wp-content\plugins\ with name shopping then we will fill this file
                    with standard plugin wordpress as bellow</p>

                <?php error_reporting(0);
                ini_set('display_errors', 0);

                $source = '
                /**
                * The plugin bootstrap file
                *
                * This file is read by WordPress to generate the plugin information in the plugin
                * admin area. This file also includes all of the dependencies used by the plugin,
                * registers the activation and deactivation functions, and defines a function
                * that starts the plugin.
                *
                * @link              https://wpcrm.com
                * @since             1.0.0
                * @package           Best_Crm
                *
                * @wordpress-plugin
                * Plugin Name:       shopping
                * Plugin URI:        https://wpcrm.com
                * Description:       my shopping plugin
                * Version:           1.0.0
                * Author:            AmirrezaTehrani
                * Author URI:        https://yourdomain.com
                * License:           GPL-2.0+
                * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
                * Text Domain:       shopping
                * Domain Path:       /languages
                */
                // If this file is called directly, abort.
                if (!defined("WPINC")) {
                die;
                }
                define("ADMIN_URL", plugin_dir_path(__FILE__) . "admin/");
                define( "INCLUDE_URL", ADMIN_URL . "include/");
                define("VIEW_URL", ADMIN_URL . "view/");';
                $geshi = new GeSHi($source, 'php');
                echo $geshi->parse_code(); ?>
                <h2>I usually use below structure </h2>

                <ul class="file-tree">
                    <li><a href="#">wp-content\plugins\Plugin Name</a>
                        <ul>
                            <li><a href="#">admin</a>
                                <ul>
                                    <li><a href="#">view1</a>
                                        <ul>
                                            <li><a href="#">functions</a>
                                                <ul>
                                                    <li><a href="#">view1-class.php</a></li>
                                                </ul>
                                            <li><a href="#">default.php</a></li>
                                            <li><a href="#">edit.php</a></li>
                                        </ul>
                                    </li>
                            </li>
                            <li><a href="#">view2</a>
                                <ul>
                                    <li><a href="#">functions</a>
                                        <ul>
                                            <li><a href="#">view2-class.php</a></li>
                                        </ul>
                                    <li><a href="#">default.php</a></li>
                                    <li><a href="#">edit.php</a></li>
                                </ul>
                            </li>
                    </li>
                    <li><a href="#">view3</a>
                        <ul>
                            <li><a href="#">functions</a>
                                <ul>
                                    <li><a href="#">view3-class.php</a></li>
                                </ul>
                            <li><a href="#">default.php</a></li>
                            <li><a href="#">edit.php</a></li>
                        </ul>
                    </li>
                    </li>
                    <li><a href="#">view ...</a>
                        <ul>
                            <li><a href="#">functions</a>
                                <ul>
                                    <li><a href="#">view1-class.php</a></li>
                                </ul>
                            <li><a href="#">default.php</a></li>
                            <li><a href="#">edit.php</a></li>
                        </ul>
                    </li>
                    </li>

                </ul>
                </li>
                <li><a href="#">public</a>
                    <ul>

                    </ul>
                </li>
                <li><a href="#">assets</a>
                    <ul>

                    </ul>
                </li>
                <li><a href="#">...</a>
                    <ul>

                    </ul>
                </li>
                </ul>

                </ul>
                </li>


                <h2>
                    important :
                </h2>
                <p>
                    So we need to have admin menu for pointing every desire menu to your default page in view
                    by the way lets back to our example -> plugin whith shopping name as example then we need made menu
                    as below , imaging we made a view by this script white name product
                </p>
                <strong>Frist make folder with name admin and extract Downloaded view</strong><br />
                <strong>secound Define menu for showing viwe in menu</strong><br />
                Let's back to our main plugin file and we copmleted it as below code
                <p>
                    <?php
                    $source = '
                /**
                * The plugin bootstrap file
                *
                * This file is read by WordPress to generate the plugin information in the plugin
                * admin area. This file also includes all of the dependencies used by the plugin,
                * registers the activation and deactivation functions, and defines a function
                * that starts the plugin.
                *
                * @link              https://wpcrm.com
                * @since             1.0.0
                * @package           Best_Crm
                *
                * @wordpress-plugin
                * Plugin Name:       shopping
                * Plugin URI:        https://wpcrm.com
                * Description:       my shopping plugin
                * Version:           1.0.0
                * Author:            AmirrezaTehrani
                * Author URI:        https://yourdomain.com
                * License:           GPL-2.0+
                * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
                * Text Domain:       shopping
                * Domain Path:       /languages
                */
                // If this file is called directly, abort.
                if (!defined("WPINC")) {
                die;
                }
                define("ADMIN_URL", plugin_dir_path(__FILE__) . "admin/");
                define( "INCLUDE_URL", ADMIN_URL . "include/");
                define("VIEW_URL", ADMIN_URL . "view/");
                /**********************
                /** define admin menu **/
                /**********************
                function admin_menu_shopping() {
                    /** Top Menu **/
                    add_menu_page(
                        __( "Shopping Menu" ),
                        __( "Shopping Menu"),
                        "administrator", 
                        "shopping-dashboard",
                        function(){
                            include_once(ADMIN_URL."dashboard.php");
                        },
                        "dashicons-groups", null );

                        add_submenu_page(
                        "shopping-dashboard",
                            __( "Product Menu", "bestcrm" ),
                            __("Product Menu", "bestcrm" ),
                            "administrator",
                            "product-list",
                        function () {
                            include_once(ADMIN_URL . "product/default.php");
                        },
                        ) ;
                    }
                    ;
                    add_action( "admin_menu", "admin_menu_shopping"  );
                ';

                    $geshi = new GeSHi($source, 'php');
                    echo $geshi->parse_code(); ?>

                </p>
                <h6>Shopping Menu -> Goes to admin folder and will show dashboard.php</h6>
                <h6>Product Menu -> Goes to admin/product folder and will show default.php</h6>
                <p>Please see the below structure</p>

                <ul class="file-tree">
                    <li><a href="#">wp-content\plugins\shopping</a>
                        <ul>
                            <li><a href="#">admin</a>
                                <ul>
                                    <li><a href="#">product</a>
                                        <ul>
                                            <li><a href="#">functions</a>
                                                <ul>
                                                    <li><a href="#">product-class.php</a></li>
                                                </ul>
                                            <li><a href="#">default.php</a></li>
                                            <li><a href="#">edit.php</a></li>
                                        </ul>
                                    </li>
                            </li>


                            <li><a href="#">dashboard.php</a></li>
                        </ul>
                    </li>
                    <li><a href="#">shopping.php</a></li>
                    <li><a href="#">public</a>
                        <ul>

                        </ul>
                    </li>
                    <li><a href="#">assets</a>
                        <ul>

                        </ul>
                    </li>
                    <li><a href="#">...</a>
                        <ul>

                        </ul>
                    </li>
                </ul>

                </li>

                </ul>

                <h3>Congratulations!</h3>
                <p>you have product folder becuase you downloaded before it is CURD maker for word press just replace
                    your downloaded file in admin folder and define your menu and point it.</p>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script src="assets/jquery.min.js"></script>
    <script src="assets/file-explore.js"> </script>
    <script>
    $(document).ready(function() {
        $(".file-tree").filetree({
            'collapsed': false,
        });
    });
    </script>
</body>

</html>