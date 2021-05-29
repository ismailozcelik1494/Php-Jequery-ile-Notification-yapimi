# Php-Jequery-ile-Notification-yapimi

Php ve Jequery kullanarak Notification yapmayı anlatıyor

Jquery ile Bildirim Sistemi

İsmail ÖZÇELİK

Herhangi bir durumda kullanıcının ekranında açılan alertbox kullanarak, kullanıcıya bildirim göstermek isteyebilirsiniz hatta ses kullanarak. 

JQuery ile bunu yapmak çok basit hemen nasıl yapılacağına geçiyorum.


![image](https://user-images.githubusercontent.com/71672398/120067320-9223ca80-c083-11eb-887a-4b93067d3d95.png)


İlk önce javascript kodlarımızı hazırlıyoruz, tabi öncesinde jquery kütüphanesininde include edilmiş olması lazım.

` <script type="text/javascript" src="js/jquery.min.js"></script> `

`<script>`

`$(document).ready(setInterval(function(){ `

  ` $.ajax({ `
  
  `type:'POST',`
  
   `url:'denetle.php',`
   
   `data:'alert=',`
   
   `cache:false,`
   
   `success:function(msg){`
   
    `$('#alertbox').fadeIn('slow').prepend(msg);`
    
    `$('#alerts').delay(8000).fadeOut('slow');`
    
   `}`
   
`}); }, 10000));`

`</script>`

Burada setInterval kullanarak 10 sn (10000 milisaniye)'de bir denetle.php isimli dosyayı çalıştırmasını söylüyoruz eğer bir veri var ise alertboxu yavaş hareketlerle 8 saniye gösterip kaybetmesini söylüyoruz. Bu facebook bildirimlerine benzetilebilir. Burada denetlenecek dosyayı, süreleri değiştirebilirsiniz

Daha sonra alertboxun dizaynı için css kodlarımızı ekliyoruz.

`<style>`

`#alerts:hover{background-color:#C6D3EC;}`

`#alerts{ font-family:Tahoma, Geneva, sans-serif; color:#000; font-size:11px; margin:5px;padding:4px; border:solid #9dabc9 1px; width:250px; height:80px;border-radius:5px; background-color:#e2e7ee}`

`#alerts li{ margin:0; padding:0; list-style:none; cursor:pointer;}`

`#alertbox{position:fixed;width:250px; height:auto; left:100px; bottom:10px;}`

`</style>`

Bu kodlarda tasarımınıza uygun değişiklikler yapabilirsiniz. HTML bir div ekliyoruz bunu </body> etiketinden önce koyabilirsiniz.

`<div id="alertbox"> </div>`

Şimdi sıra geldi denetleme yapacağı dosyaya. Bu dosyada örneğin veri tabanında bir tabloda veya satırında bir değişiklik veya ekleme olduğunda alerbox çıktısı üretecek şekilde kullanabilirsiniz. Eğer böyle bir şey yapacaksanız ilgili tabloda birde bildirim için bir sütun daha oluşturmanız gerekli. Örneğin yeni bir kayıt oluştuğunda kullanıcıya bildirim gösterecekseniz time ve notif diye bir sutün ekleyip, varsayılan değer 1 olacak şekilde ayarlayın. Kullanıcı ekrana bağlandığında veya o an bağlı ise denetle.php dosyası çalışacak bildirim veya bildirimleri göstererek otomatik notif sutununu sıfır yaptırabilirsiniz.

Eğer birden fazla kullanıcı aynı değişikliği görmesi gerekiyor ise ona göre bir düzenleme ve algoritma oluşturmanız gerekiyor.

Bir diğeri ise eğer bildirimler sadece o an ekranda bağlı olan birden fazla kullanıcılar için gösterilecekse unix biçiminde zaman tutan bir alan daha açıp kayıt eklenir eklenmez alana on anki saniye yazılarak, denetle.php dosyasında 9 saniyeden daha yeni ise (if (fark) < 9) kontrolü yaptırdığınızda, alertbox 10 saniyede bir dosyayı kontrol edeceği için ikinci kontrole kadar kullanıcılara bildirimler gösterilecek ve daha sonrasında gösterilmeyecektir. Biraz karışık gelebilir ama bu benim kullandığım bir algoritma siz istediğiniz gibi kodlayabilirsiniz.

`if($veri['notif'] == '1'){`
     
     `echo '<div id="alerts">`
     
     `<audio id="audioplayer" autoplay=true>`
     
      `<source src="sound/glass.mp3" type="audio/mpeg">`
       
       `Tarayiciniz ses elementlerini desteklemiyor. </audio>`
       
     `<li>`
     
     `<img src="icons/no.png" align="top" style="float:left; margin-right:2px;" />`
     
     `<div><strong>Yeni Mesaj Var</strong><br /> Falan Filan Gödnerdi<br />  </div> Abuk Sabuk`
     
     `</li>`
     
     `</div>';`
     
`$mysqli->query("UPDATE tabloadi SET notif='0' WHERE id=".$veri['id']." ");`

`}else {`

`}`

Örneğin basitçe oluşturduğum php dosyasi bu tabi öncesinde veri tabanında sorgulamalar yapılıyor. Siz kendinize göre düzenleyin. Asp veya diğer web dilleri ile de kendinize uygun yapabilirsiniz. Benim kullandığım ses dosyasını aşağıdaki linkten indirebilirsiniz.

Uygulama php ile yazılmıştır. İçinde bulacağınız sql klasörü altındaki tabloyu mysql veri tabanınızda oluşturmanız gerekiyor. Daha sonra denetle.php isimli dosyada (notepad++ ile açabilirsiniz) 4. satırda bulunan bağlantı ayarlarını kendi sisteminize uygun şekilde yapmanız gerekmektedir.

Browserınızdan index.html dosyasını çalıştırdıktan sonra notification isimli tabloda bir veri girişi yapın.

`INSERT INTO `notification` (`konu`, `mesaj`, `notif`) VALUES ('Deneme', 'Test', '1');`

notif kısmının 1 olması gerektiğine dikkat edin. Buradaki 1'in anlamı henüz bu bildirimin okunmadığı anlamı taşır. denetle.php bu veriyi okuduktan sonra bu sütunu 0 yapmaktadır. Böylece bir bildirim bir kere karşınıza çıkar. denetle.php dosyasını incelediğinizde mantığın basit olduğunu göreceksiniz. Browserınızdan açtığınız index.html sayfasına geri dönün bir süre sonra (10 sn içinde) bildirimin sol alt köşeye geldiğini görecek ve ses duyacaksınız. Bildirim ekranı bir süre sonra kendi kendine kaybolacaktır.

Veri tabanına yeni giriş yaparak veya notif kısmını tekrar 1 yaparak tekrar tekrar test edebilirsiniz. (index.html sayfasını yenilemenize gerek yok. denetle.php 10 saniyede bir veri tabanını kontrol etmektedir)

![image](https://user-images.githubusercontent.com/71672398/120067873-838ae280-c086-11eb-8ea5-a215c4d3adae.png)
 
Bu benim oluşturduğum basit bir mantık siz ihtiyacınıza göre istediğiniz algoritmada bildirim sistemini kullanabilirsiniz.
