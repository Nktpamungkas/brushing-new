<?php
ini_set("error_reporting", 1);
session_start();
include ("../koneksi.php");
// var_dump($_POST);

if ($_POST['save'] == 'simpen') {
    $sql = mysqli_query($con, "INSERT INTO tbl_splb SET
        `NO_KARTU_KERJA`='$_POST[NO_KARTU_KERJA]',
        `LANGGANAN`='$_POST[LANGGANAN]',
        `TANGGAL_01`='$_POST[TANGGAL_01]',
        `ORDER`='$_POST[ORDER]',
        `JENIS_KAIN`=" . "'" . str_replace("'", "''", $_POST['JENIS_KAIN']) . "'" . ",
        `NOTE`='$_POST[NOTE]',
        `WARNA`='$_POST[WARNA]',
        `L_PERMINTAAN`='" . floatval($_POST['L_PERMINTAAN']) . "',
        `G_PERMINTAAN`='" . floatval($_POST['G_PERMINTAAN']) . "',
        `L_AKTUAL`='" . floatval($_POST['L_AKTUAL']) . "',
        `G_AKTUAL`='" . floatval($_POST['G_AKTUAL']) . "',
        `LOT`='$_POST[LOT]',
        `NO_HANGER`='$_POST[NO_HANGER]',
        `NAMA_TTD`='$_POST[NAMA_TTD]',
        `BAG_KAIN_01`='$_POST[BAG_KAIN_01]',
        `BAG_KAIN_02`='$_POST[BAG_KAIN_02]',
        `BAG_KAIN_03`='$_POST[BAG_KAIN_03]',
        `BAG_KAIN_04`='$_POST[BAG_KAIN_04]',
        `BAG_KAIN_05`='$_POST[BAG_KAIN_05]',
        `BAG_KAIN_06`='$_POST[BAG_KAIN_06]',
        `BAG_KAIN_07`='$_POST[BAG_KAIN_07]',
        `BAG_KAIN_08`='$_POST[BAG_KAIN_08]',
        `BAG_KAIN_09`='$_POST[BAG_KAIN_09]',
        `BAG_KAIN_10`='$_POST[BAG_KAIN_10]',
        `BAG_KAIN_11`='$_POST[BAG_KAIN_11]',
        `BAG_KAIN_12`='$_POST[BAG_KAIN_12]',
        `BAG_KAIN_13`='$_POST[BAG_KAIN_13]',
        `BAG_KAIN_14`='$_POST[BAG_KAIN_14]',
        `JAR_GARUK_01`='$_POST[JAR_GARUK_01]',
        `JAR_GARUK_02`='$_POST[JAR_GARUK_02]',
        `JAR_GARUK_03`='$_POST[JAR_GARUK_03]',
        `JAR_GARUK_04`='$_POST[JAR_GARUK_04]',
        `JAR_GARUK_05`='$_POST[JAR_GARUK_05]',
        `JAR_GARUK_06`='$_POST[JAR_GARUK_06]',
        `JAR_GARUK_07`='$_POST[JAR_GARUK_07]',
        `JAR_GARUK_08`='$_POST[JAR_GARUK_08]',
        `JAR_GARUK_09`='$_POST[JAR_GARUK_09]',
        `JAR_GARUK_10`='$_POST[JAR_GARUK_10]',
        `JAR_GARUK_11`='$_POST[JAR_GARUK_11]',
        `JAR_GARUK_12`='$_POST[JAR_GARUK_12]',
        `JAR_GARUK_13`='$_POST[JAR_GARUK_13]',
        `JAR_GARUK_14`='$_POST[JAR_GARUK_14]',
        `DRUM_01`='$_POST[DRUM_01]',
        `DRUM_02`='$_POST[DRUM_02]',
        `DRUM_03`='$_POST[DRUM_03]',
        `DRUM_04`='$_POST[DRUM_04]',
        `DRUM_05`='$_POST[DRUM_05]',
        `DRUM_06`='$_POST[DRUM_06]',
        `DRUM_07`='$_POST[DRUM_07]',
        `DRUM_08`='$_POST[DRUM_08]',
        `DRUM_09`='$_POST[DRUM_09]',
        `DRUM_10`='$_POST[DRUM_10]',
        `DRUM_11`='$_POST[DRUM_11]',
        `DRUM_12`='$_POST[DRUM_12]',
        `DRUM_13`='$_POST[DRUM_13]',
        `DRUM_14`='$_POST[DRUM_14]',
        `JAR_SISIR_01`='$_POST[JAR_SISIR_01]',
        `JAR_SISIR_02`='$_POST[JAR_SISIR_02]',
        `JAR_SISIR_03`='$_POST[JAR_SISIR_03]',
        `JAR_SISIR_04`='$_POST[JAR_SISIR_04]',
        `JAR_SISIR_05`='$_POST[JAR_SISIR_05]',
        `JAR_SISIR_06`='$_POST[JAR_SISIR_06]',
        `JAR_SISIR_07`='$_POST[JAR_SISIR_07]',
        `JAR_SISIR_08`='$_POST[JAR_SISIR_08]',
        `JAR_SISIR_09`='$_POST[JAR_SISIR_09]',
        `JAR_SISIR_10`='$_POST[JAR_SISIR_10]',
        `JAR_SISIR_11`='$_POST[JAR_SISIR_11]',
        `JAR_SISIR_12`='$_POST[JAR_SISIR_12]',
        `JAR_SISIR_13`='$_POST[JAR_SISIR_13]',
        `JAR_SISIR_14`='$_POST[JAR_SISIR_14]',
        `SPEED01`='$_POST[SPEED01]',
        `SPEED02`='$_POST[SPEED02]',
        `SPEED03`='$_POST[SPEED03]',
        `SPEED04`='$_POST[SPEED04]',
        `SPEED05`='$_POST[SPEED05]',
        `SPEED06`='$_POST[SPEED06]',
        `SPEED07`='$_POST[SPEED07]',
        `SPEED08`='$_POST[SPEED08]',
        `SPEED09`='$_POST[SPEED09]',
        `SPEED10`='$_POST[SPEED10]',
        `SPEED11`='$_POST[SPEED11]',
        `SPEED12`='$_POST[SPEED12]',
        `SPEED13`='$_POST[SPEED13]',
        `SPEED14`='$_POST[SPEED14]',
        `TENSION1_01`='$_POST[TENSION1_01]',
        `TENSION1_02`='$_POST[TENSION1_02]',
        `TENSION1_03`='$_POST[TENSION1_03]',
        `TENSION1_04`='$_POST[TENSION1_04]',
        `TENSION1_05`='$_POST[TENSION1_05]',
        `TENSION1_06`='$_POST[TENSION1_06]',
        `TENSION1_07`='$_POST[TENSION1_07]',
        `TENSION1_08`='$_POST[TENSION1_08]',
        `TENSION1_09`='$_POST[TENSION1_09]',
        `TENSION1_10`='$_POST[TENSION1_10]',
        `TENSION1_11`='$_POST[TENSION1_11]',
        `TENSION1_12`='$_POST[TENSION1_12]',
        `TENSION1_13`='$_POST[TENSION1_13]',
        `TENSION1_14`='$_POST[TENSION1_14]',
        `TENSION2_01`='$_POST[TENSION2_01]',
        `TENSION2_02`='$_POST[TENSION2_02]',
        `TENSION2_03`='$_POST[TENSION2_03]',
        `TENSION2_04`='$_POST[TENSION2_04]',
        `TENSION2_05`='$_POST[TENSION2_05]',
        `TENSION2_06`='$_POST[TENSION2_06]',
        `TENSION2_07`='$_POST[TENSION2_07]',
        `TENSION2_08`='$_POST[TENSION2_08]',
        `TENSION2_09`='$_POST[TENSION2_09]',
        `TENSION2_10`='$_POST[TENSION2_10]',
        `TENSION2_11`='$_POST[TENSION2_11]',
        `TENSION2_12`='$_POST[TENSION2_12]',
        `TENSION2_13`='$_POST[TENSION2_13]',
        `TENSION2_14`='$_POST[TENSION2_14]',
        `TENSION3_01`='$_POST[TENSION3_01]',
        `TENSION3_02`='$_POST[TENSION3_02]',
        `TENSION3_03`='$_POST[TENSION3_03]',
        `TENSION3_04`='$_POST[TENSION3_04]',
        `TENSION3_05`='$_POST[TENSION3_05]',
        `TENSION3_06`='$_POST[TENSION3_06]',
        `TENSION3_07`='$_POST[TENSION3_07]',
        `TENSION3_08`='$_POST[TENSION3_08]',
        `TENSION3_09`='$_POST[TENSION3_09]',
        `TENSION3_10`='$_POST[TENSION3_10]',
        `TENSION3_11`='$_POST[TENSION3_11]',
        `TENSION3_12`='$_POST[TENSION3_12]',
        `TENSION3_13`='$_POST[TENSION3_13]',
        `TENSION3_14`='$_POST[TENSION3_14]',
        `SHEARING_1`='$_POST[SHEARING_1]',
        `SHEARING_2`='$_POST[SHEARING_2]',
        `TUMBLEDRY`='$_POST[TUMBLEDRY]',
        `SPEED_KAIN_B`='$_POST[SPEED_KAIN_B]',
        `SPEED_KAIN_F`='$_POST[SPEED_KAIN_F]',
        `SPEED_M_MNT_B`='$_POST[SPEED_M_MNT_B]',
        `SPEED_M_MNT_F`='$_POST[SPEED_M_MNT_F]',
        `SPEED_JARUM_B`='$_POST[SPEED_JARUM_B]',
        `SPEED_JARUM_F`='$_POST[SPEED_JARUM_F]',
        `JARAK_PISAU_B`='$_POST[JARAK_PISAU_B]',
        `JARAK_PISAU_F`='$_POST[JARAK_PISAU_F]',
        `AIRO`='$_POST[AIRO]',
        `SPEED_DRM_B`='$_POST[SPEED_DRM_B]',
        `SPEED_DRM_F`='$_POST[SPEED_DRM_F]',
        `BLACK_DRAGROLL`='$_POST[BLACK_DRAGROLL]',
        `SPEED_TARIKAN_KAIN_B`='$_POST[SPEED_TARIKAN_KAIN_B]',
        `SPEED_TARIKAN_KAIN_F`='$_POST[SPEED_TARIKAN_KAIN_F]',
        `PILE_BRUSH`='$_POST[PILE_BRUSH]',
        `PLAITER_TENSION`='$_POST[PLAITER_TENSION]',
        `COUNTERPILE_BRUSH`='$_POST[COUNTERPILE_BRUSH]',
        `REDUCED_SUEDING`='$_POST[REDUCED_SUEDING]',
        `JAR_GARUK_B`='$_POST[JAR_GARUK_B]',
        `JAR_GARUK_F`='$_POST[JAR_GARUK_F]',
        `DELIVERY_BRUSH`='$_POST[DELIVERY_BRUSH]',
        `SPEED_KAIN`='$_POST[SPEED_KAIN]',
        `DRUM_B`='$_POST[DRUM_B]',
        `DRUM_F`='$_POST[DRUM_F]',
        `TAKER_IN_TENSION`='$_POST[TAKER_IN_TENSION]',
        `SPEED_DRUM`='$_POST[SPEED_DRUM]',
        `JAR_SISIR_B`='$_POST[JAR_SISIR_B]',
        `JAR_SISIR_F`='$_POST[JAR_SISIR_F]',
        `FRONT_DRUM_TENSION`='$_POST[FRONT_DRUM_TENSION]',
        `SPEED_TOTATION`='$_POST[SPEED_TOTATION]',
        `SPEED_B`='$_POST[SPEED_B]',
        `SPEED_F`='$_POST[SPEED_F]',
        `REAR_DRUM_TENSION`='$_POST[REAR_DRUM_TENSION]',
        `LOAD_CELLS_CTRL`='$_POST[LOAD_CELLS_CTRL]',
        `TENSION_B`='$_POST[TENSION_B]',
        `TENSION_F`='$_POST[TENSION_F]',
        `SPEED_POLISHING`='$_POST[SPEED_POLISHING]',
        `SUHU_ROLLER_F`='$_POST[SUHU_ROLLER_F]',
        `SUHU_ROLLER_B`='$_POST[SUHU_ROLLER_B]',
        `GAP_01`='$_POST[GAP_01]',
        `GAP_02`='$_POST[GAP_02]',
        `SPEED_RLR_F`='$_POST[SPEED_RLR_F]',
        `SPEED_RLR_B`='$_POST[SPEED_RLR_B]',
        `TENSION_01`='$_POST[TENSION_01]',
        `TENSION_02`='$_POST[TENSION_02]',
        `SUEDING_03_SPEED`='$_POST[SUEDING_03_SPEED]',
        `TEK_REGULATOR`='$_POST[TEK_REGULATOR]',
        `TEKANAN_KAIN_01`='$_POST[TEKANAN_KAIN_01]',
        `TEKANAN_KAIN_02`='$_POST[TEKANAN_KAIN_02]',
        `TEKANAN_KAIN_03`='$_POST[TEKANAN_KAIN_03]',
        `TEKANAN_KAIN_04`='$_POST[TEKANAN_KAIN_04]',
        `TEKANAN_KAIN_05`='$_POST[TEKANAN_KAIN_05]',
        `TEKANAN_KAIN_06`='$_POST[TEKANAN_KAIN_06]',
        `SPEED_SIKAT_01`='$_POST[SPEED_SIKAT_01]',
        `SPEED_SIKAT_02`='$_POST[SPEED_SIKAT_02]',
        `SPEED_SIKAT_03`='$_POST[SPEED_SIKAT_03]',
        `SPEED_SIKAT_04`='$_POST[SPEED_SIKAT_04]',
        `SPEED_SIKAT_05`='$_POST[SPEED_SIKAT_05]',
        `SPEED_SIKAT_06`='$_POST[SPEED_SIKAT_06]',
        `QUALITY`='$_POST[QUALITY]',
        `SUEDING_04_SPEED`='$_POST[SUEDING_04_SPEED]',
        `TANGGAL_02`='$_POST[TANGGAL_02]',
        `TEKANAN04_01`='$_POST[TEKANAN04_01]',
        `TEKANAN04_02`='$_POST[TEKANAN04_02]',
        `TEKANAN04_03`='$_POST[TEKANAN04_03]',
        `TEKANAN04_04`='$_POST[TEKANAN04_04]',
        `TEKANAN04_05`='$_POST[TEKANAN04_05]',
        `TEKANAN04_06`='$_POST[TEKANAN04_06]',
        `SIKAT04_01`='$_POST[SIKAT04_01]',
        `SIKAT04_02`='$_POST[SIKAT04_02]',
        `SIKAT04_03`='$_POST[SIKAT04_03]',
        `SIKAT04_04`='$_POST[SIKAT04_04]',
        `SIKAT04_05`='$_POST[SIKAT04_05]',
        `SIKAT04_06`='$_POST[SIKAT04_06]',
        `COUNTER_PILE1`='$_POST[COUNTER_PILE1]',
        `COUNTER_PILE2`='$_POST[COUNTER_PILE2]',
        `COUNTER_PILE3`='$_POST[COUNTER_PILE3]',
        `COUNTER_PILE4`='$_POST[COUNTER_PILE4]',
        `COUNTER_PILE5`='$_POST[COUNTER_PILE5]',
        `COUNTER_PILE6`='$_POST[COUNTER_PILE6]',
        `COUNTER_PILE7`='$_POST[COUNTER_PILE7]',
        `COUNTER_PILE8`='$_POST[COUNTER_PILE8]',
        `COUNTER_PILE9`='$_POST[COUNTER_PILE9]',
        `COUNTER_PILE10`='$_POST[COUNTER_PILE10]',
        `COUNTER_PILE11`='$_POST[COUNTER_PILE11]',
        `COUNTER_PILE12`='$_POST[COUNTER_PILE12]',
        `COUNTER_PILE13`='$_POST[COUNTER_PILE13]',
        `COUNTER_PILE14`='$_POST[COUNTER_PILE14]',
        `PILE1`='$_POST[PILE1]',
        `PILE2`='$_POST[PILE2]',
        `PILE3`='$_POST[PILE3]',
        `PILE4`='$_POST[PILE4]',
        `PILE5`='$_POST[PILE5]',
        `PILE6`='$_POST[PILE6]',
        `PILE7`='$_POST[PILE7]',
        `PILE8`='$_POST[PILE8]',
        `PILE9`='$_POST[PILE9]',
        `PILE10`='$_POST[PILE10]',
        `PILE11`='$_POST[PILE11]',
        `PILE12`='$_POST[PILE12]',
        `PILE13`='$_POST[PILE13]',
        `PILE14`='$_POST[PILE14]',
        `TENSIONDEPAN1` = '$_POST[TENSIONDEPAN1]',
        `TENSIONDEPAN2` = '$_POST[TENSIONDEPAN2]',
        `TENSIONDEPAN3` = '$_POST[TENSIONDEPAN3]',
        `TENSIONDEPAN4` = '$_POST[TENSIONDEPAN4]',
        `TENSIONDEPAN5` = '$_POST[TENSIONDEPAN5]',
        `TENSIONDEPAN6` = '$_POST[TENSIONDEPAN6]',
        `TENSIONDEPAN7` = '$_POST[TENSIONDEPAN7]',
        `TENSIONDEPAN8` = '$_POST[TENSIONDEPAN8]',
        `TENSIONDEPAN9` = '$_POST[TENSIONDEPAN9]',
        `TENSIONDEPAN10` = '$_POST[TENSIONDEPAN10]',
        `TENSIONDEPAN11` = '$_POST[TENSIONDEPAN11]',
        `TENSIONDEPAN12` = '$_POST[TENSIONDEPAN12]',
        `TENSIONDEPAN13` = '$_POST[TENSIONDEPAN13]',
        `TENSIONDEPAN14` = '$_POST[TENSIONDEPAN14]',
        `TENSIONBELAKANG1` = '$_POST[TENSIONBELAKANG1]',
        `TENSIONBELAKANG2` = '$_POST[TENSIONBELAKANG2]',
        `TENSIONBELAKANG3` = '$_POST[TENSIONBELAKANG3]',
        `TENSIONBELAKANG4` = '$_POST[TENSIONBELAKANG4]',
        `TENSIONBELAKANG5` = '$_POST[TENSIONBELAKANG5]',
        `TENSIONBELAKANG6` = '$_POST[TENSIONBELAKANG6]',
        `TENSIONBELAKANG7` = '$_POST[TENSIONBELAKANG7]',
        `TENSIONBELAKANG8` = '$_POST[TENSIONBELAKANG8]',
        `TENSIONBELAKANG9` = '$_POST[TENSIONBELAKANG9]',
        `TENSIONBELAKANG10` = '$_POST[TENSIONBELAKANG10]',
        `TENSIONBELAKANG11` = '$_POST[TENSIONBELAKANG11]',
        `TENSIONBELAKANG12` = '$_POST[TENSIONBELAKANG12]',
        `TENSIONBELAKANG13` = '$_POST[TENSIONBELAKANG13]',
        `TENSIONBELAKANG14` = '$_POST[TENSIONBELAKANG14]',
        `TENSIONKELUAR1` = '$_POST[TENSIONKELUAR1]',
        `TENSIONKELUAR2` = '$_POST[TENSIONKELUAR2]',
        `TENSIONKELUAR3` = '$_POST[TENSIONKELUAR3]',
        `TENSIONKELUAR4` = '$_POST[TENSIONKELUAR4]',
        `TENSIONKELUAR5` = '$_POST[TENSIONKELUAR5]',
        `TENSIONKELUAR6` = '$_POST[TENSIONKELUAR6]',
        `TENSIONKELUAR7` = '$_POST[TENSIONKELUAR7]',
        `TENSIONKELUAR8` = '$_POST[TENSIONKELUAR8]',
        `TENSIONKELUAR9` = '$_POST[TENSIONKELUAR9]',
        `TENSIONKELUAR10` = '$_POST[TENSIONKELUAR10]',
        `TENSIONKELUAR11` = '$_POST[TENSIONKELUAR11]',
        `TENSIONKELUAR12` = '$_POST[TENSIONKELUAR12]',
        `TENSIONKELUAR13` = '$_POST[TENSIONKELUAR13]',
        `TENSIONKELUAR14` = '$_POST[TENSIONKELUAR14]',
        `POTONGBULU1` = '$_POST[POTONGBULU1]',
        `POTONGBULU2` = '$_POST[POTONGBULU2]',
        `SPEEDM/MNT_B` = '$_POST[SPEEDM/MNT_B]',
        `SPEEDM/MNT_F` = '$_POST[SPEEDM/MNT_F]',
        `JARAKPISAU_B` = '$_POST[JARAKPISAU_B]',
        `JARAKPISAU_F` = '$_POST[JARAKPISAU_F]',
        `%PILEBRUSH_B` = '$_POST[%PILEBRUSH_B]',
        `%PILEBRUSH_F` = '$_POST[%PILEBRUSH_F]',
        `%COUNTERPILEBRUSH_B` = '$_POST[%COUNTERPILEBRUSH_B]',
        `%COUNTERPILEBRUSH_F` = '$_POST[%COUNTERPILEBRUSH_F]',
        `SIKATBELAKANG_B` = '$_POST[SIKATBELAKANG_B]',
        `SIKATBELAKANG_F` = '$_POST[SIKATBELAKANG_F]',
        `SPEEDMESIN_B` = '$_POST[SPEEDMESIN_B]',
        `SPEEDMESIN_F` = '$_POST[SPEEDMESIN_F]',
        `SPEEDJARUM_B` = '$_POST[SPEEDJARUM_B]',
        `SPEEDJARUM_F` = '$_POST[SPEEDJARUM_F]',
        `SPEEDDRUM_F` = '$_POST[SPEEDDRUM_F]',
        `SPEEDDRUM_B` = '$_POST[SPEEDDRUM_B]',
        `SPEEDTARIKANKAIN_B` = '$_POST[SPEEDTARIKANKAIN_B]',
        `SPEEDTARIKANKAIN_F` = '$_POST[SPEEDTARIKANKAIN_F]',
        `TENSIONMASUK_B` = '$_POST[TENSIONMASUK_B]',
        `TENSIONMASUK_F` = '$_POST[TENSIONMASUK_F]',
        `TENSIONTENGAH_B` = '$_POST[TENSIONTENGAH_B]',
        `TENSIONTENGAH_F` = '$_POST[TENSIONTENGAH_F]',
        `SPEEDKAIN_B` = '$_POST[SPEEDKAIN_B]',
        `SPEEDKAIN_F` = '$_POST[SPEEDKAIN_F]',
        `PEACHSKINSPEEDDRUM_B` = '$_POST[PEACHSKINSPEEDDRUM_B]',
        `PEACHSKINSPEEDDRUM_F` = '$_POST[PEACHSKINSPEEDDRUM_F]',
        `ANTIPILLING` = '$_POST[ANTIPILLING]',
        `MISTPRAY` = '$_POST[MISTPRAY]',
        `STEAM` = '$_POST[STEAM]',
        `OVEN` = '$_POST[OVEN]',
        `PENDINGIN` = '$_POST[PENDINGIN]',
        `SUHU` = '$_POST[SUHU]',
        `SUHUFRONTROLLER_B` = '$_POST[SUHUFRONTROLLER_B]',
        `SUHUFRONTROLLER_F` = '$_POST[SUHUFRONTROLLER_F]',
        `SUHUBACKROLLER_B` = '$_POST[SUHUBACKROLLER_B]',
        `SUHUBACKROLLER_F` = '$_POST[SUHUBACKROLLER_F]',
        `SPEEDBACKROLLER_B` = '$_POST[SPEEDBACKROLLER_B]',
        `SPEEDBACKROLLER_F` = '$_POST[SPEEDBACKROLLER_F]',
        `SUEDEROLLER1_B` = '$_POST[SUEDEROLLER1_B]',
        `SUEDEROLLER1_F` = '$_POST[SUEDEROLLER1_F]',
        `SUEDEROLLER2_B` = '$_POST[SUEDEROLLER2_B]',
        `SUEDEROLLER2_F` = '$_POST[SUEDEROLLER2_F]',
        `SUEDEROLLER3_B` = '$_POST[SUEDEROLLER3_B]',
        `SUEDEROLLER3_F` = '$_POST[SUEDEROLLER3_F]',
        `SUEDEROLLER4_B` = '$_POST[SUEDEROLLER4_B]',
        `SUEDEROLLER4_F` = '$_POST[SUEDEROLLER4_F]',
        `SUEDEROLLER1(S/B)_B` = '$_POST[SUEDEROLLER1(S/B)_B]',
        `SUEDEROLLER1(S/B)_F` = '$_POST[SUEDEROLLER1(S/B)_F]',
        `SUEDEROLLER2(S/B)_B` = '$_POST[SUEDEROLLER2(S/B)_B]',
        `SUEDEROLLER2(S/B)_F` = '$_POST[SUEDEROLLER2(S/B)_F]',
        `SUEDEROLLER3(S/B)_B` = '$_POST[SUEDEROLLER3(S/B)_B]',
        `SUEDEROLLER3(S/B)_F` = '$_POST[SUEDEROLLER3(S/B)_F]',
        `SUEDEROLLER4(S/B)_B` = '$_POST[SUEDEROLLER4(S/B)_B]',
        `SUEDEROLLER4(S/B)_F` = '$_POST[SUEDEROLLER4(S/B)_F]',
        `TENSIONPOTENSIONER(N)_B` = '$_POST[TENSIONPOTENSIONER(N)_B]',
        `TENSIONPOTENSIONER(N)_F` = '$_POST[TENSIONPOTENSIONER(N)_F]',
        `TENSIONFEEDINGROLLER(N)_B` = '$_POST[TENSIONFEEDINGROLLER(N)_B]',
        `TENSIONFEEDINGROLLER(N)_F` = '$_POST[TENSIONFEEDINGROLLER(N)_F]',
        `PENETRATOR01(%)_B` = '$_POST[PENETRATOR01(%)_B]',
        `PENETRATOR01(%)_F` = '$_POST[PENETRATOR01(%)_F]',
        `PENETRATOR02(%)_B` = '$_POST[PENETRATOR02(%)_B]',
        `PENETRATOR02(%)_F` = '$_POST[PENETRATOR02(%)_F]',
        `TENSION1_B` = '$_POST[TENSION1_B]',
        `TENSION1_F` = '$_POST[TENSION1_F]',
        `TENSION2_B` = '$_POST[TENSION2_B]',
        `TENSION2_F` = '$_POST[TENSION2_F]',
        `NOMESIN` = '$_POST[NOMESIN]',
        `SPEEDROLL` = '$_POST[SPEEDROLL]',
        `VENTILATOR` = '$_POST[VENTILATOR]',
        `SUHUOVEN` = '$_POST[SUHUOVEN]',
        `WAKTUOVEN` = '$_POST[WAKTUOVEN]',
        `AIROPENDINGIN` = '$_POST[AIROPENDINGIN]',
        `WAKTUPENDINGIN` = '$_POST[WAKTUPENDINGIN]',
        `TENSIONBELAKANG_B` = '$_POST[TENSIONBELAKANG_B]',
        `TENSIONBELAKANG_F` = '$_POST[TENSIONBELAKANG_F]',
        `TENSIONBELAKANG2_B` = '$_POST[TENSIONBELAKANG2_B]'
        `TENSIONBELAKANG2_F` = '$_POST[TENSIONBELAKANG2_F]',
        `OK` = '$_POST[OK]',
        `NOT_OK` = '$_POST[NOT_OK]',
        `DEAMAND` = '$_POST[DEAMAND]',
        `WETSUEDING` = '$_POST[WETSUEDING]'
        

    ");

    if ($sql) {
        echo "<script>alert('insert SETTING PERBEDAAN LOT BRUSHING berhasil !'); window.location.href='index.php?p=home'; </script>";
    } else {
        echo "<script>alert('insert SETTING PERBEDAAN LOT BRUSHING gagal !'); window.location.href='index.php?p=home'; </script>";
    }
}