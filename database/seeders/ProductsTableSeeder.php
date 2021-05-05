<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'user_id' => 1,
                'title' => 'جا گلدانی پایه بلند',
                'description' => 'در سه رنگ سفید مشکی نقره ای',
                'price' => '200',
                'inventory' => 4,
                'image' => url('img\products\product3.jpg')
            ],
            [
                'user_id' => 1,
                'title' => 'آینه و کنسول چوبی',
                'description' => 'در ابعاد مختلف',
                'price' => '100',
                'inventory' => 4,
                'image' => url('img\products\product6.jpg')
            ],
            [
                'user_id' => 1,
                'title' => 'کوسن سفید',
                'description' => 'الیافی بسیار نرم',
                'price' => '30',
                'inventory' => 4,
                'image' => url('img\products\product7.jpg')
            ],
            [
                'user_id' => 1,
                'title' => 'جلو مبلی چوبی',
                'description' => 'در سه رنگ متفاوت با اندازه های مختلف',
                'price' => '200',
                'inventory' => 4,
                'image' => url('img\products\product8.jpg')
            ],
            [
                'user_id' => 1,
                'title' => 'نظم دهنده آشپزخانه',
                'description' => 'در ابعاد مختلف با جنس مقاوم',
                'price' => '70',
                'inventory' => 4,
                'image' => url('img\products\product9.jpg')
            ],
            [
                'user_id' => 1,
                'title' => 'پیرمرد و دریا',
                'description' => 'کتابی بسیار جذاب',
                'price' => '50',
                'inventory' => 4,
                'image' => url('img\products\product5.jpg')
            ],
            [
                'user_id' => 1,
                'title' => 'امیدوارم منو پیدا کنی',
                'description' => 'اشعاری در وصف عشق',
                'price' => '60',
                'inventory' => 4,
                'image' => url('img\products\product10.jpg')
            ],
            [
                'user_id' => 1,
                'title' => 'من اینجام',
                'description' => 'راهنمای جامع و خلاق',
                'price' => '40',
                'inventory' => 4,
                'image' => url('img\products\product11.jpg')
            ],
            [
                'user_id' => 1,
                'title' => 'چهارده هزار دلیل برای خوشحالی',
                'description' => 'کتابی شاد برای زندگی شاد',
                'price' => '50',
                'inventory' => 4,
                'image' => url('img\products\product13.jpg')
            ],
            [
                'user_id' => 1,
                'title' => 'دو تیکه تاپ و دامن',
                'description' => 'الیاف بسیار نخی',
                'price' => '80',
                'inventory' => 4,
                'image' => url('img\products\product4.jpg')
            ],
            [
                'user_id' => 1,
                'title' => 'دامن ساتن',
                'description' => 'دامن بلند ساتن اعلا در رنگبندی متنوع',
                'price' => '110',
                'inventory' => 4,
                'image' => url('img\products\product14.jpg')
            ],
            [
                'user_id' => 1,
                'title' => 'پیراهن بلند تابستونی',
                'description' => 'پیراهن حریر دخترانه با رنگبندی تابستانه',
                'price' => '240',
                'inventory' => 4,
                'image' => url('img\products\product15.jpg')
            ],
            [
                'user_id' => 1,
                'title' => 'شومیز زنانه',
                'description' => 'شومیز زنانه سفید همراه با کمربند',
                'price' => '180',
                'inventory' => 4,
                'image' => url('img\products\product16.jpg')
            ],
            [
                'user_id' => 1,
                'title' => 'مانتو شلوار',
                'description' => 'مانتو شلوار تابستانی دخترانه در سایز بندی و رنگ های متنوع',
                'price' => '230',
                'inventory' => 4,
                'image' => url('img\products\product17.jpg')
            ],
            [
                'user_id' => 1,
                'title' => 'پیراهن حریر',
                'description' => 'پیراهن آستین بلند حریر مجلسی در رنگبندی متنوع',
                'price' => '300',
                'inventory' => 4,
                'image' => url('img\products\product18.jpg')
            ],
            [
                'user_id' => 1,
                'title' => 'شوینده بهداشتی صورت',
                'description' => 'مناسب برای انواع پوست',
                'price' => '60',
                'inventory' => 5,
                'image' => url('img\products\product1.jpg')
            ],
            [
                'user_id' => 1,
                'title' => 'ست لوازم آرایش',
                'description' => 'ست محصولات مراقبت از پوست با قیمتی مناسب',
                'price' => '340',
                'inventory' => 4,
                'image' => url('img\products\product19.jpg')
            ],
            [
                'user_id' => 1,
                'title' => 'روغن های مراقبت از پوست',
                'description' => 'سرشار از مواد مغذی جهت بستن منافذ پوست',
                'price' => '280',
                'inventory' => 4,
                'image' => url('img\products\product20.jpg')
            ],
            [
                'user_id' => 1,
                'title' => 'ماساژور صورت',
                'description' => 'ماساژور همراه با کرم شفاف کننده',
                'price' => '290',
                'inventory' => 4,
                'image' => url('img\products\product21.jpg')
            ],
            [
                'user_id' => 1,
                'title' => 'محفظه نگهدارنده آرایشی',
                'description' => 'قابل سفارش در رنگبندی و سایزهای متفاوت',
                'price' => '320',
                'inventory' => 4,
                'image' => url('img\products\product22.jpg')
            ],
            [
                'user_id' => 1,
                'title' => 'ست براش 15 تایی',
                'description' => 'پانزده عدد براش در کاربردهای متفاوت با سری قابل شستشو همراه با کیف',
                'price' => '320',
                'inventory' => 4,
                'image' => url('img\products\product23.jpg')
            ],
            [
                'user_id' => 1,
                'title' => 'گوشی سامسونگ',
                'description' => 'دارای قابلیت های مختلف',
                'price' => '100',
                'inventory' => 4,
                'image' => url('img\products\product2.jpg')
            ],
            [
                'user_id' => 1,
                'title' => 'قاب گوشی',
                'description' => 'قاب های گوشی برای مدل های متفاوت موبایل',
                'price' => '75',
                'inventory' => 4,
                'image' => url('img\products\product24.jpg')
            ],
            [
                'user_id' => 1,
                'title' => 'موبایل سامسونگ',
                'description' => 'مدل سیگنال ایکس با حافظه 64 گیگا بایت',
                'price' => '1200',
                'inventory' => 4,
                'image' => url('img\products\product25.jpg')
            ],
            [
                'user_id' => 1,
                'title' => 'پایه نگهدارنده موبایل',
                'description' => 'پایه های مقاوم نگهدارنده موبایل با مدل های متفاوت',
                'price' => '80',
                'inventory' => 4,
                'image' => url('img\products\product26.jpg')
            ],
            [
                'user_id' => 1,
                'title' => 'موبایل نوکیا',
                'description' => 'بسیار خوش دست با رنگبندی متنوع همراه با شارژر',
                'price' => '900',
                'inventory' => 4,
                'image' => url('img\products\product27.jpg')
            ],
            [
                'user_id' => 1,
                'title' => 'موبایل سامسونگ مدل آ 70',
                'description' => 'حافظه داخلی 128 گیگا بایت  به همراه 2 دوربین عقب با وضوح 13 مگاپیکسل',
                'price' => '2500',
                'inventory' => 4,
                'image' => url('img\products\product28.jpg')
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
