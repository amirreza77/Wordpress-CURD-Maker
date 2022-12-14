# Wordpress CURD Maker 
Download and extract this script in your local or we and simply make CRUD for wordpress and use it in your wp project as view it make your life simple 
Just fill the form and download your desire view.
![Logo](https://iili.io/HoE4wGa.png)

# What You Should Do After Download
Frist of all you should know this file is not plugin or excutable file BUT it could be make your Life simple as a wordpress developer.
 

### Your Downloaded file could be a one of your View in your plugin it is CRUD based on your Project 

frist of all make your admin menu in your project as example imagin your proget-name is ``shopping``
so we need to creat folder in wp-content\plugins\ with name shopping then we will fill this file with standard plugin wordpress as bellow


```php
<?php
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
?>
```
# I usually use below structure
![Logo](https://iili.io/HoE8loJ.png)

##  important :
 So we need to have admin menu for pointing every desire menu to your default page in view by the way lets back to our example -> plugin whith shopping name as example then we need made menu as below , imaging we made a view by this script white name product

#### Frist make folder with name admin and extract Downloaded view
#### Secound Define menu for showing viwe in menu

Let's back to our main plugin file , in this case we call it shopping.php and we will copmlete it as below code

```php
<?php
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
 ?> 
```
#### Shopping Menu -> Goes to admin folder and will show dashboard.php
#### Product Menu -> Goes to admin/product folder and will show default.php
 Please see the below structure

![Logo](https://iili.io/HoEgucl.png)

# Congratulations!
you have product folder becuase you downloaded before it is CURD maker for word press just replace your downloaded file in admin folder and define your menu and point it.
