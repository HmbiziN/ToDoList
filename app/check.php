<?php
if(isset($_POST['id'])){
    require '../db_connect.php';
    $id = $_POST['id'];
    if(empty($id)){
        echo 'error';
    }else {
        $todos = $conn->prepare("SELECT id, checked FROM todos WHERE id=?");
        $todos->execute([$id]);
        $todo = $todos->fetch();
        $uid = $todo['id'];
        $checked = $todo['checked'];
        $uchecked = $checked ? 0 : 1;
        $res = $conn->query("UPDATE todos Set checked=$uchecked WHERE id=$uid");
        if($res){
            echo $checked;
        }else{
            echo 'error';
        }
        $conn = null;
        exit();
    }
}else {
    header("Location: ../index.php?mess=error");

}

?>