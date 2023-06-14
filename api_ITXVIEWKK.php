<?php
    session_start();
    include_once "koneksi.php";
    $_noprod    = $_GET['noprod'];
    $sql = "SELECT
                TRIM(PRODUCTIONORDERCODE) AS PRODUCTIONORDERCODE,
                TRIM(DEAMAND) AS DEMAND,
                ORIGDLVSALORDERLINEORDERLINE AS ORDERLINE,
                TRIM(PROJECTCODE) AS PROJECTCODE,
                ORDPRNCUSTOMERSUPPLIERCODE,
                TRIM(SUBCODE01) AS SUBCODE01, 
                TRIM(SUBCODE02) AS SUBCODE02,
                TRIM(SUBCODE03) AS SUBCODE03, 
                TRIM(SUBCODE04) AS SUBCODE04,
                TRIM(SUBCODE05) AS SUBCODE05, 
                TRIM(SUBCODE06) AS SUBCODE06,
                TRIM(SUBCODE07) AS SUBCODE07, 
                TRIM(SUBCODE08) AS SUBCODE08,
                TRIM(SUBCODE09) AS SUBCODE09, 
                TRIM(SUBCODE10) AS SUBCODE10,
                TRIM(ITEMTYPEAFICODE) AS ITEMTYPEAFICODE,
                DSUBCODE05 AS NO_WARNA,
                TRIM(DSUBCODE02) || '-' || TRIM(DSUBCODE03) AS NO_HANGER,
                TRIM(ITEMDESCRIPTION) AS ITEMDESCRIPTION
            FROM 
                ITXVIEWKK 
        WHERE 
            PRODUCTIONORDERCODE LIKE '%$_noprod%'";
    $query  = db2_exec($conn_db2, $sql);
    $dt     = db2_fetch_assoc($query);

    $sql2 = "SELECT 
                i.LEBAR,
                CASE
                    WHEN i2.GRAMASI_KFF IS NULL THEN i2.GRAMASI_FKF
                    ELSE
                        i2.GRAMASI_KFF
                END AS GRAMASI 
            FROM 
                ITXVIEWLEBAR i 
            LEFT JOIN ITXVIEWGRAMASI i2 ON i2.SALESORDERCODE = '$dt[PROJECTCODE]' AND i2.ORDERLINE = '$dt[ORDERLINE]'
            WHERE 
                i.SALESORDERCODE = '$dt[PROJECTCODE]' AND i.ORDERLINE = '$dt[ORDERLINE]'";
    $query2 = db2_exec($conn_db2, $sql2);
    $dt2    = db2_fetch_assoc($query2);

    $sql3 = "SELECT 
                DELIVERYDATE
            FROM 
                SALESORDERDELIVERY 
            WHERE 
                SALESORDERLINESALESORDERCODE = '$dt[PROJECTCODE]' AND SALESORDERLINEORDERLINE = '$dt[ORDERLINE]'";
    $query3 = db2_exec($conn_db2, $sql3);
    $dt3    = db2_fetch_assoc($query3);
    
    $sql4 = "SELECT 
                TRIM(LANGGANAN) AS PELANGGAN,
                TRIM(BUYER) AS BUYER
            FROM 
                ITXVIEW_PELANGGAN 
            WHERE 
                ORDPRNCUSTOMERSUPPLIERCODE = '$dt[ORDPRNCUSTOMERSUPPLIERCODE]' AND CODE = '$dt[PROJECTCODE]'";
    $query4 = db2_exec($conn_db2, $sql4);
    $dt4    = db2_fetch_assoc($query4);
    
    $sql5 = "SELECT 
                TRIM(WARNA) AS WARNA
            FROM 
                ITXVIEWCOLOR 
            WHERE 
                ITEMTYPECODE = '$dt[ITEMTYPEAFICODE]' 
                AND SUBCODE01 = '$dt[SUBCODE01]' 
                AND SUBCODE02 = '$dt[SUBCODE02]'
                AND SUBCODE03 = '$dt[SUBCODE03]' 
                AND SUBCODE04 = '$dt[SUBCODE04]'
                AND SUBCODE05 = '$dt[SUBCODE05]' 
                AND SUBCODE06 = '$dt[SUBCODE06]'
                AND SUBCODE07 = '$dt[SUBCODE07]' 
                AND SUBCODE08 = '$dt[SUBCODE08]'
                AND SUBCODE09 = '$dt[SUBCODE09]' 
                AND SUBCODE10 = '$dt[SUBCODE10]'";
    $query5 = db2_exec($conn_db2, $sql5);
    $dt5    = db2_fetch_assoc($query5);

    $sql6 = "SELECT 
                TRIM(EXTERNALREFERENCE) AS NO_PO
            FROM 
                ITXVIEW_KGBRUTO 
            WHERE 
                PROJECTCODE = '$dt[PROJECTCODE]' AND ORIGDLVSALORDERLINEORDERLINE = '$dt[ORDERLINE]'";
    $query6 = db2_exec($conn_db2, $sql6);
    $dt6    = db2_fetch_assoc($query6);

    $sql7 = "SELECT 
                    USEDUSERPRIMARYQUANTITY AS QTY_ORDER,
                    USERSECONDARYQUANTITY AS QTY_ORDER_YARD,
                    TRIM(USERSECONDARYUOMCODE) AS SATUAN_QTY
                FROM 
                    ITXVIEW_RESERVATION 
                WHERE 
                    PRODUCTIONORDERCODE = '$dt[PRODUCTIONORDERCODE]' AND (ITEMTYPEAFICODE = 'KGF' OR ITEMTYPEAFICODE = 'DYC')";
    $query7 = db2_exec($conn_db2, $sql7);
    $dt7    = db2_fetch_assoc($query7);
    
    //Menampung data yang dihasilkan
    if($dt7['QTY_ORDER']){
        $QTY_ORDER  = $dt7['QTY_ORDER'];
    }else{
        $QTY_ORDER  = null;
    }
    if($dt7['QTY_ORDER_YARD']){
        $QTY_ORDER_YARD  = $dt7['QTY_ORDER_YARD'];
    }else{
        $QTY_ORDER_YARD  = null;
    }
    if($dt7['SATUAN_QTY']){
        $QTY_SATUAN     = $dt7['SATUAN_QTY'];
    }else{
        $QTY_SATUAN = null;
    }
    $ITEMDESC       = str_replace('"', "`", $dt['ITEMDESCRIPTION']);
    $json = array(
        'PRODUCTIONORDERCODE'   => $dt['PRODUCTIONORDERCODE'],
        'DEAMAND'               => $dt['DEMAND'],
        'ORDERLINE'             => $dt['ORDERLINE'],
        'PELANGGAN'             => $dt4['PELANGGAN'],
        'BUYER'                 => $dt4['BUYER'],
        'PROJECTCODE'           => $dt['PROJECTCODE'],
        'NO_PO'                 => $dt6['NO_PO'],
        'NO_HANGER'             => $dt['NO_HANGER'],
        'ITEMDESCRIPTION'       => $ITEMDESC,
        'DELIVERYDATE'          => $dt3['DELIVERYDATE'],
        'LEBAR'                 => $dt2['LEBAR'],
        'GRAMASI'               => $dt2['GRAMASI'],
        'WARNA'                 => $dt5['WARNA'],
        'NO_WARNA'              => $dt['NO_WARNA'],
        'QTY_ORDER'             => $QTY_ORDER,
        'QTY_ORDER_YARD'        => $QTY_ORDER_YARD,
        'SATUAN_QTY'            => $QTY_SATUAN
    );
    
    //Merubah data kedalam bentuk JSON
    header('Content-Type: application/json');
    echo json_encode($json);
?>