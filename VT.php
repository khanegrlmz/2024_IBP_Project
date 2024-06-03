<?php

class VT {
    var $sunucu = "localhost";
    var $user = "root";
    var $password = "";
    var $dbname = "yoneticipaneli"; 
    var $baglanti;

    public function filter($input) {
        // Filtreleme işlemleri burada gerçekleştirilir
        return $input; // Örnek olarak şu an sadece girdiyi doğrudan geri döndürüyoruz
    }
    


    function __construct() {
        try {
            $this->baglanti = new PDO("mysql:host=".$this->sunucu.";dbname=".$this->dbname.";charset=utf8", $this->user, $this->password); 
        } catch (PDOException $error) {
            echo $error->getMessage();
            exit();
        }
    }
    /* SELECT *FROM ayarlar WHERE ID=1 ORDER BY ID ASC LIMIT 1*/
    public function VeriGetir($tablo,$wherealanlar="",$wherearraydeger="",$orderby="ORDER BY ID ASC",$limit="")
    {
 
        $this->baglanti->query("SET CHARACTER SET utf8");
        $sql="SELECT * FROM ".$tablo; /* SELECT *FROM ayarlar*/
        if(!empty($wherealanlar)&& !empty($wherearraydeger))
        {
            $sql.=" ".$wherealanlar;/*SELECT *FROM ayarlarWHERE*/
            if(!empty($orderby)){$sql=" ".$orderby;}
            if(!empty($limit)){$sql="LIMIT".$limit;}
            $calistir=$this->baglanti->prepare($sql);
           
            //$sonuc=$calistir->execute($wherearraydeger);
            $veri=$calistir->fetchAll(PDO::FETCH_ASSOC);
           

        }
        else
        {
            if(!empty($orderby)){$sql="".$orderby;}
            if(!empty($limit)){$sql="LIMIT".$limit;}
            $veri=$this->baglanti->query($sql,PDO::FETCH_ASSOC);
        }


        if($veri!=false&& !empty($veri)){
            $datalar=array();
            foreach($veri as $bilgiler){
                $datalar[]=$bilgiler;

            }
            return $datalar;
        }

    }

}
?>
