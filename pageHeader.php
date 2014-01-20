<?php
//
// $cart_with_number = false;
if (! isset($new_header)) {
	$new_header = true;
	}
// THIS IS THE NEW HEADER! WHEEEE!
function pageGroup() {
    $thisDir =  pathinfo($_SERVER['PHP_SELF'], PATHINFO_DIRNAME);
    $thisPage =  pathinfo($_SERVER['PHP_SELF'], PATHINFO_BASENAME);

    $result = '';

    if (($thisDir == '/') && ($thisPage == 'index.php')) {
        $result = 'Home';
    }
    else if ($thisDir == '/why-choose-us') {
        $result = 'Why Choose Us?';
    }
    else if (($thisDir == '/big-button-cell-phone') && ($thisPage == 'index.php')) {
        $result = 'Phone';
    }
    else if ($thisDir == '/senior-cell-phone-plans') {
        $result = 'Plans';
    }
    else if ($thisDir == '/shop') {
        $result = 'Shop';
    }
    else if ($thisDir ==  '/catalog') {
        $result = 'Shop';
    }
    else if ($thisDir == '/one-call') {
        $result = 'oneCall';
    }
    else if ($thisDir == '/activate') {
        $result = 'Activate Phone';
    }

    return $result;
    //error_log("result: " . $result);
    }

function pageGroup2() {
    $thisDir =  pathinfo($_SERVER['PHP_SELF'], PATHINFO_DIRNAME);
    $thisPage =  pathinfo($_SERVER['PHP_SELF'], PATHINFO_BASENAME);

    $result = "home";

    if (($thisDir == "/") && ($thisPage == "index.php")) {
        $result = "home";
        }
    else if (($thisDir == '/about-snapfon-products') && ($thisPage == "ez-one-features.php")) {
        $result = 'phone';
        }
    else if (($thisDir == '/about-snapfon-products') && ($thisPage == "eztwo-features.php")) {
        $result = 'phone';
        }
    else if (($thisDir == "/services") && ($thisPage == 'onecall_mobile.php')) {
        $result = 'onecall';
        }
    else if (strpos( $thisDir, 'plans')) {
        $result = 'plans';
        }
    else if (strpos( $thisDir, 'catalog')) {
        $result = 'catalog';
        }
    else if (strpos( $thisDir, 'customer-testimonials')) {
        $result = 'reviews';
        }
    else if (strpos( $thisDir, 'services')) {
        $result = 'services';
        }
    else if (strpos( $thisDir, 'CellPhonePlansforSeniors')) {
        $result = 'plans';
        }
    else if (strpos( $_SERVER['REQUEST_URI'], 'sec=em')) {
        $result = 'contact';
        }
    else if (strpos( $thisDir, 'support')) {
        $result = 'support';
        }
    else if (strpos( $thisDir, 'dealer-information')) {
        $result = 'support';
        }
    else if (($thisDir == '/about-snapfon-products') && ($thisPage == "default.php")) {
        $result = 'aboutus';
        }
    else if (strpos( $thisDir, 'activate')) {
        $result = 'activate';
        }

    return $result;
    }

$inCatalog = false;
// Ugh. inCatalog turns out to be useless...
if (defined('PROJECT_VERSION')) {
	$inCatalog = true;
	}
else {
	include_once(DIR_FS_ROOT . "/catalog/includes/product_id_values.php");
	}

if (IS_KIOSK_STORE && (!in_array(pageGroup2(), array('catalog', 'activate')))) {
	// This looks like a good place to dump them into the catalog/checkout system, no?
	// Note that tep_href_link() EXPECTS to be inside the catalog directory, so it always appends that to whatever filename you pass it.
//	die('Excuse me.<br />You appear to have veered off course. <a href="/shop/">Try your portal page.</a>');
	if(STORES_ID == 11) {
		tep_redirect( tep_href_link("../activate/activate-snapfon.php"));
		} 
	else {
		tep_redirect( tep_href_link("index.php"));
		}
	}

$returnButtonActive = false;

$showExtraShit = false;
if ($inCatalog && tep_session_is_registered('customer_id') && ($customer_id == 2)) {
	$showExtraShit = true;
	}

// echo "<h1 style='color: red; font-size: 5em;'>Website ordering is temporarily down for Maintenance.</h1>";
if ((isset( $checkoutPage) && ($checkoutPage > 1)) || IS_KIOSK_STORE) { ?>
    <table id="pageHeader" border="0">
        <tr>
            <td id='logo' rowspan="2">
				<? if (IS_KIOSK_STORE && (STORES_ID < STORES_KIOSK)) { ?>
					<script type="text/javascript">
						function doBeginReturnProcess() {
							roid = prompt("Scan the barcode at the bottom of the receipt or type in the order number that is being returned.", "")
							if (roid) {
								if (parseInt( roid, 10) > 0) {
									document.location.href = "returns_gather_info.php?op=checkroid&roid=" + roid
									}
								else {
									alert( "Invalid order number. Please try again.")
									}
								}
							}
						function doGoBack() {
							document.location.href = "<?= $goBackPage ?>"
							}
					</script>
					<a href='<?= $mainSitePath; ?>index.php'><img src="<?= $mainSitePath ?>images/snapLogo.png" alt="Cellphones, Service Plans & Accessories for Seniors | Seniortech LLC" title="Snapfon: Manufacturer of Mobile Phones for Seniors" width="219" height="80" id='snapLogo' /></a>
					<? if ((!isset( $checkoutPage) || $checkoutPage < 1) && !isset( $returnsPage)) {
						$returnButtonActive = true; ?>
						<br>
						<button id='returnButton' onclick="doBeginReturnProcess()">Begin Return Process</button>
					<? } else if (isset( $returnsPage)) { ?>
						<br>
						<button id='goBackButton' onclick="doGoBack()">Back</button>
					<? } ?>
				<? } else { ?>
					<img src="<?= $mainSitePath ?>images/snapLogo.png" alt="Snapfon Mobile Phones for Seniors" title="Snapfon: Manufacturer of Mobile Phones for Seniors" width="219" height="80" id='snapLogo' />
				<? } ?>
						</td>
						<td width='756'>
<?php if (IS_KIOSK_STORE) { ?>
<script src="<?= $mainSitePath; ?>js/dojo.1.5.2/dojo/dojo.js" type="text/javascript"></script>
							<span class='session'>
							<div class='stat'<?= ($_SESSION['customer_first_name']) ? " ready'>Customer: <button title='Logout' onClick='customerLogout();'>{$_SESSION['customer_first_name']}" : ">Customer: <button onClick='document.location.href=\"{$mainSitePath}catalog/login.php\";'>Login"; ?></button>
								<button onClick='document.location="<?= $mainSitePath; ?>activate/activate-snapfon.php";'>Activate</button>
							</div>
							<span class='blue button' onclick='document.location.href="<?= $mainSitePath?>catalog/shopping_cart.php";'>Checkout</span>
							<?= ($_SESSION['pin_valid']) ? "<div class='stat ready' style='float: right;'>CSR: <button title='Logout' onClick='verifyPin();'>{$_SESSION['pin_admin_name']}</button></div>" : ''; ?>
							</span>
<?php } ?>
							<? if ($checkoutPage > 1) { ?>
					<? if (!(tep_session_is_registered( 'this_is_a_reseller_activation') && ($this_is_a_reseller_activation == 1))) { ?>
						<img src="images/cart/Cart-Step-<?= $checkoutPage ?>.png" alt="Checkout Step <?= $checkoutPage ?>." width="756" height="75" usemap="#checkoutMap" >
						<map id="checkoutMap" name="checkoutMap">
							<area shape="rect" alt="Shopping Cart" title="Shopping Cart" coords="4,4,90,73" href="<?= HTTP_SERVER ?>/catalog/shopping_cart.php" target="" />
							<area shape="rect" alt="Billing Shipping Info" title="Billing Shipping Info" coords="168,0,254,73" href="<?= HTTPS_SERVER ?>/catalog/checkout_gather_info.php" target="" />
							<area shape="rect" alt="Shipping Method" title="Shipping Method" coords="334,1,421,69" href="<?= HTTPS_SERVER ?>/catalog/checkout_shipping_guest.php" target="" />
							<area shape="rect" alt="Order Confirmation" title="Order Confirmation" coords="500,0,588,73" href="<?= HTTPS_SERVER ?>/catalog/checkout_confirmation.php" target="" />
							<area shape="rect" alt="Order Complete!" title="Order Complete!" coords="669,2,754,73" data-href="nada.php" target="" />
						</map>
					<? } ?>
								<? } ?>
						</td>
				</tr>
		</table>
		<script type='text/javascript'>
			function customerLogout() {
				dojo.xhrPost({
					url: "<?= $mainSitePath; ?>catalog/logoff.php",
					timeout: 3000,
					content: { },
					handleAs: "text",
					sync: true,
					handle: function(resultData, ioArgs) {
						document.location = '<?= $_SERVER['SCRIPT_NAME']; ?>';
					}
				});
				return false;
			}
			function verifyPin(thePin) {
				dojo.xhrPost({
					url: "<?= $mainSitePath; ?>catalog/ajax/cart_actions_2.php",
					timeout: 3000,
					content: {
						op: "verify_reseller_pin",
						pin: thePin
					},
					handleAs: "json",
					sync: true,
					handle: function(resultData, ioArgs) {
						if (resultData.result == "success") {
							document.location = '<?= $_SERVER['SCRIPT_NAME']; ?>';
						} else {
							if (thePin == null) {
								customerLogout();
							} else {
								alert('PIN failure:' + resultData.Message);
							}
							theResult = false;
						}
					}
				});
				return false;
				}
		</script>
<?    
	if (IS_KIOSK_STORE && ($_SESSION['pin_store'] != STORES_ID || $_SESSION['pin_valid'] == false)) { ?>
		<form name='csrLogin' onSubmit='return verifyPin(this.pin.value);'>
		PIN: <input type='password' name='pin' size='5' maxlength='4' />
		<input type='submit' value=' Login ' />
		</form>
		<script type='text/javascript'>
			$(document).ready(function() {
				document.csrLogin.pin.focus();
				});
		</script>
<?php
		include(DIR_FS_ROOT . '/includes/pageFooter.php');
		die();
		}
	}
else { ?>
    <? //if ((pageGroup() != "activate") && function_exists("tep_session_is_registered") && tep_session_is_registered('customer_id') && ($customer_id == 257)) { //} ?>
<? if ($new_header) { ?>
  <script>
  // Place holder for cart with quantity display
  </script>
<?php $mpath = '/images/menu/menu2013'; ?>
  <div id='pageHeader'>
    <a href='/'><img class='logo' src='<?= $mainSitePath ?>images/menu/menu2013/snapfon-the-cellphone-for-seniors-logo.png' alt='Snapfon, The cellphone for seniors' title='Snapfon: Manufacturer of Mobile Phones for Seniors' id='snapLogo' /></a>

<?php
	if (false) $holiday = '<span style="color: red;">Offices Closed Labor Day</span><br />';
	elseif (false) $holiday = '<span style="color: red; font-size: 16px">Offices Closed Thursday &amp; Friday<br />for Thanksgiving</span><br />';
	elseif (false) $holiday = '<span style="color: red;">Offices Closed Christmas</span><br />';
	elseif (false) $holiday = '<span style="color: red;">Offices Closed New Years Day</span><br />';
?>
    <div class='account_phone_cart_menu' style='position: relative;'>
			<div class='note'>
				<div class='inner ezGreen'<?= ($holiday == '') ? '': " style='font-size: 18px;'"; ?>>
					No Contracts &amp; Free Accessory<br />
					<?= $holiday; ?>
				</div>
				<div class='vam'></div>
			</div>
      <ul class='accountStuff'>
<?php
      if ($inCatalog) {
        // If the customer is already logged in, take them to the store
        if (tep_session_is_registered('customer_id')) {
?>
        <li>
          <a href='<?= $mainSitePath ?>catalog/account.php'>My Account</a> |
        </li>
        <li>
          <a href='<?= $mainSitePath ?>catalog/logoff.php'>Log Off</a>
        </li>
<?php } else { ?>
        <li>
          <a href='<?= $mainSitePath ?>catalog/login.php'>Account Login</a> |
        </li>
        <li>
          <a href='<?= $mainSitePath ?>catalog/create_account.php'>Register</a>
        </li>
<?php } } ?>
      </ul>

      <div class='phone_cart'>
        <div class='phone'>
          <div class='ezGreen bigText'>(423) 535-9968</div>
          <?php
      $number = '(800) 937-1532';
      if ($mobile) {
        echo "<a href='tel:+18009371532'>$number</a>\n";
      } else {
        echo "$number\n";
      } ?>
        </div>

<?php if ($cart_with_number) { ?>
        <a class='cart' href='/shop/shopping_cart.php'>
          <span class='cart_qty'>
            <span></span>
          </span>
        </a>

<?php } else { ?>
        <?php $mname = '/images/cart-icon'; ?>
        <style> .cart { background-image: url() ! important; } </style>
        <a class='cart' href='/shop/shopping_cart.php'><img height='44' src='<?= $mname; ?>.png' onMouseOut='this.src="<?= $mname; ?>.png";' onMouseUp='this.src="<?= $mname; ?>.png";' onMouseOver='this.src="<?= $mname; ?>_over.png";' onMouseDown='this.src="<?= $mname; ?>_click.png";' ></a>
<?php } ?>

      </div>

      <div class='menubar'>
        <ul class='menu'>
<?php
  $menubar = array(
     'Home'           => '/',
     'Why Choose Us?' => '/why-choose-us/',
     'Phone'          => '/big-button-cell-phone/',
     'Plans'          => '/senior-cell-phone-plans/',
     'Shop'           => '/shop/',
  );
  foreach ($menubar as $menu_title => $menu_url) {
    $menu_selected = ((pageGroup() == $menu_title) ? ' class=\'selected\'' : '');
    echo "          <li><a href='$menu_url'$selected>$menu_title</a> |</li>";
  }
?>
          <li>
            <?php $mname = $mpath . '/sosPlus-button'; ?>
            <a href='/one-call/'><img class='menubutton' src='<?= $mname; ?>.png' onMouseOut='this.src="<?= $mname; ?>.png";' onMouseUp='this.src="<?= $mname; ?>.png";' onMouseOver='this.src="<?= $mname; ?>_over.png";' onMouseDown='this.src="<?= $mname; ?>_click.png";' ></a>
          </li>
          <li>
            <?php $mname = $mpath . '/slim-activate-button'; ?>
            <a href='/activate/activate-snapfon.php'><img class='menubutton' src='<?= $mname; ?>.png' onMouseOut='this.src="<?= $mname; ?>.png";' onMouseUp='this.src="<?= $mname; ?>.png";' onMouseOver='this.src="<?= $mname; ?>_over.png";' onMouseDown='this.src="<?= $mname; ?>_click.png";' ></a>
          </li>
        </ul>
      </div>
    </div>
    <!-- AddThis Button BEGIN -->
    <div class="addthis_toolbox addthis_32x32_style">
      <a class="addthis_button_facebook damnButton"></a>
      <a class="addthis_button_twitter damnButton"></a>
      <!-- a class="addthis_button_email damnButton"></a -->
      <a class="addthis_button_compact"></a>
      <span id='social_buttons'></span>
      <script type="text/javascript">
      x = '<script type="text/javascript">var addthis_config = {"data_track_addressbar":false};<\/script><script type="text/javascript" src="https://s7.addthis.com/js/250/addthis_widget.js#pubid=ra-502d33b86f7a8568"><\/script>';
      $(document).ready( function() {
        $('#social_buttons').after(x);
      });
      </script>
    </div>
    <!-- AddThis Button END -->
  </div>
    <? } ?>
<? /* print_r( $browser_info);
    ***<? echo pathinfo($_SERVER['PHP_SELF'],  PATHINFO_DIRNAME); ?>***<br>
    ***<? echo pathinfo($_SERVER['PHP_SELF'],  PATHINFO_BASENAME); ?>***<br>
    ***<? echo pageGroup2(); ?>***<br>
  *
  */
?>
<? } ?>
<?
preg_match_all('/\d+/', `free | sed -n '3p'`, $m);
$memory['used'] = $m[0][0];
$memory['free'] = $m[0][1];
$memory['low'] = ($memory['free'] < 400*1024);
?>
