<?php
/*

php nin sorunlarından biri yalnızca tek bir mirasa sahip olabilmektir. 
Bu bir sınıfın yalnızca başka bir sınıftan miras alabileceği anlanımana gelir. Ancak çoğu zamana birden fazla sınıftan miras almak faydalı olacaktır. 
Php 5.4 de Traits olarak bilinen dilin yeni bir özelliği eklendi. Bir çeşit mixin gidibir. 
Bu çoklu kalıtım sorunlarından kaçınırken kod tekrarını azaltabileceğiniz ve antajlardan yararlanabileceğiniz anlamına gelir. 

Trait başka bir sınıfa dahil etmek istediğiniz yöntelmer grubudur. Bir nitelik, soyut bir sınıf gibi, kendi başına somutlaştırılamaz. 
*/
/*
trait Sharable{
    public function share($item)
    {
        return 'share this item: '.$item;
    }
}

class Post{
    use Sharable;
}
class Comment{
    use Sharable;
}

$post = new Post;
echo $post->share("post");

$comment = new Comment;
echo $comment->share("comment");
*/
/*
Bir Trait, temel olarak, çalışma süresi sırasında kodu "kopyalayıp yapıştırmanın" bir yoludur. 
Bu trait post ve comment sınıflarına kopyalandığı anlamına gelir, böylece yeni bir örnek başlattığınızda, share() fonksiyonu kullanılabilir olacaktır.
 */

/*
  interface den farklı olarak çalışır traitler:
 */
/*
interface Sociable{
    public function like();
    public function share();
}

trait Sharable{
    public function share($item)
    {
        ///
    }
}
class Post implements Sociable{
    use Sharable;
    public function like()
    {
        //
    }
}

$post = new Post;
if($post instanceof Sociable)
{
    $post->share("hello world");
}*/
/*
Bu örnekte, Post nesnesinin like() ve share() işlevlerini yapabildiğini belirten bir Sociable interface imiz var
Shareable Trait, share() yöntemini uygular ve like() yöntemini Pst sınıfnda uygulanır. 
*/

#YARARLARI
/*
Trait kullanmanın yararı, uygulamanız bağlamında anlamlı olmayabilecek karmaşık sınıf mirasını önlerken kod tekrarını azaltmanızdır.
Bu, açık ve özlü basit Özellikler tanımlamanıza ve ardından uygun olan yerlerde bu işlevselliği karıştırmanıza olanak tanır. 
*/

#ZARARLARI
/*
Traitler, çok fazla sorumluluğu olan şişirlmiş sınıflar sınıflar yazmayı çok kolaylaştırır. Bir trait esasen sınıflar arasında kodu "kopyalayıp yapıştırmanın"
bir yoludur. Bir sınıfa başka bir yöntem grubnu çok basit bir şekilde eklenemini bir yolunu bularak, single responsibility ilkesinden ayrılmak çok kolay olur. 
*/

#KULLANILMASI GEREKEN TİPİK DURUMLAR
/*
Traitler, aynı soyut sınıftan miras almaması gereken bir dizi benzer sınıf arasında bir kod yığınını yeniden kullanmanın mükemmel bir yolu. 
*/

/*
https://culttt.com/2014/06/25/php-traits/
*/

/*
Trait aynı sınıf tanımlama gibi yapılıyor ama class yerine trait kelimesiyle. Sınıf içerisinde kullanımı da use anahtar kelimesi ile oluyor. 
Ne extends ne de implements ile bir şey yapıyorum. Onlarla işim yok. 
Böylece oluşturduğum sınıf içinde birden çok traiti tanımlayarak bir sınıfa dahil edip (türetme oluyor) kullanabilirim.
*/

/*
Trait’lerin en önemli özelliği self ve parent reserved word kelimelerinin kullanılmasıdır.
Self için örnek:
*/
/*
trait KitapCopyrigth
{
    function yazar($yazar)
    {
        echo "Telif hakkı 2016 " . $yazar;
    }
}
trait KitapSayfaDizini
{
    use KitapCopyrigth;
    function dizayn1()
    {
        self::yazar("Serhat");
        //$this->yazar("Serhat");
        echo " Dizayn için gerekli kodlar..";
    }
}

class Kitap
{
    use KitapSayfaDizini;
}

$kitabim = new Kitap;
$kitabim->dizayn1();
*/
/*
Burada şu senaryo olabilir. Trait kullanılan classın parent classının özelliğini çağırabilir. Alttaki kodda kitap_copyrirghtın yazar fonksiyonu 
ama farklı bir classtan türetilseydi o türetilen classın yazar fonksiyonu kullanılacaktı.
Parent:
 */
class Kitap_copyright
{
    function yazar($yazar)
    {
        echo 'Telif hakkı 2016 ' . $yazar;
    }
}

trait Kitap_sayfadizayni
{
    function dizayn1()
    {
        parent::yazar('Serhat '); // bu yazar fonksiyonu trait içinde değil. Class içinde bir metod.
        echo "Dizayn için gerekli kodları farzedin...";
    }
}


class Kitap extends Kitap_copyright
{

    use  Kitap_sayfadizayni;
}

$kitabim1 = new Kitap;
$kitabim1->dizayn1();
/*
https://burhantanis.com/blog_kod_dunyam/2017/06/17/phpde-trait-olayini-derinlemesine-inceleyelim
 */