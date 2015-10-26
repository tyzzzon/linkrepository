<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
//require_once 'bootstrap.php';
//$db = new PDO('mysql:host=linkrepository;dbname=linkrepository','root','111111');
require_once "autoload.php";
//require_once "models/user_model.php";
//require_once "models/link_model.php";
//require_once "models/temporary_link_model.php";
//$Vasya = new User_Model("Vasya", "Petrov", "VP", "email@email.email", "111");
//$Petya = new User_Model("Petya", "Vasilyev", "PV", "em@em.em", "222");
//$Vasya->lets_see();
//$Petya->lets_see();
//$res = $db->query("SELECT * FROM users")->fetchAll(PDO::FETCH_ASSOC);
//foreach ($res as $re)
//{
//    echo $re["user_name"]."<br>";
//}
//$poson = new User_Model();
//$poson->create("Timofey", "Serov", "TS", "ts@email.ru", "333");
//$poson->delete("TS");
//$poson->get_from_database("TS");
//$poson->lets_see();
//$poson->edit_user_name("Petr","PV");
//echo $poson->user_id;
//$linky = new Temporary_Link_Model();
//$linky->create("thelinker", "linker.ru", "it is a linker than the link", 0, date("Y-m-d H:i"), 4);
//$linky->delete_link("link.ru", 4);
/*$linky->edit_link("thelinker", "linker.com", "it is a linker than the link", 1, 1);*/
//$linky->get_from_database("linker.ru", 4);
//$linky->create_temporary_link(5, date("Y-m-d H:i"));
//$linky->get_from_database(5);
//$linky->delete_link(1);
//$linky->check_link("erjh56kjdf", "email@email.email");
//$linky->send_temporary_link();
//echo $linky->temporary_link_id."<br>".$linky->user_id."<br>".$linky->temporary_link_hash."<br>".$linky->temporary_link_born_time."<br>";
$cont = new Edit_User_Controller();
//$cont = new Auth_Controller();
//$cont->authentification("MK", "555");
$cont->admin_edit_user("Vasya", "Petrov", "VP", "email@email.email", "111", "editor");
