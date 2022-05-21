<?php 
     require_once ('connect.php');
     $sql = 'SELECT * FROM logup';
    try{
        $stmt = $dbCon->prepare($sql);
        $stmt->execute();
    }
    catch(PDOException $ex){
        die(json_encode(array('status' => false, 'data' => $ex->getMessage())));
    }
    $data = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))

    {
        $data[] = $row;
    }
    echo json_encode(array('status' => true, 'data' => $data));
    // try{
    //     $stmt = $conn->prepare($sql);
    //     $stmt->execute();
    // }
    // catch(PDOException $ex){
    //     die(json_encode(array('status' => false, 'data' => $ex->getMessage())));
    // }

    // $data = array();
    // while ($row = $stmt->fetch(PDO::FETCH_ASSOC))

    // {
    //     $data[] = $row;
    // }
    // echo json_encode(array('status' => true, 'data' => $data));
?

