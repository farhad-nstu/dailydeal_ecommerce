<?php
use App\General;


$general = General::find(1);


return[
	'home' => 'হোম',
	'shop' => 'শপিং',
	'log_in' => 'লগইন',
	'register' => 'রেজিস্টার',
	'search' => 'প্রোডাক্ট খুজুন',
	'all' => 'সকল',
	'help_line' => 'হেল্প লাইন',
	'about_section' => $general->about_bd,
	'copyright_section' => $general->copyright_bd,
	'address_section' => $general->address_bd,
	'phone_section' => $general->phone_number_bd,
	'footer_follow' => 'অনুসরণ করুন',
	'contact_us' => 'যোগাযোগ করুন',
	'get_to_know_us' => 'আমাদের সম্পর্কে জানুন',
	'need_help' => 'সাহায্যের প্রয়োজন?',
	'exclusive_categories' => 'এক্সক্লুসিভ ক্যাটাগরি',
	'products_accessories' => 'প্রোডাক্টস & একসেসোরিজ',
	'happy_customers' => 'হ্যাপি কাস্টমার',
	'faq' => 'সাধারন জিজ্ঞাসা',
	'product_descriptions' => 'প্রোডাক্টের বিবরণ',
	'product_specifications' => 'বৈশিষ্ট্য',
	'product_reviews' => 'রিভিউ',
	'add_a_review' => 'রিভিউ দিন',
	'full_name' => 'পুরো নাম',
	'email_address' => 'ই-মেইল',
	'your_rating' => 'রেটিং',
	'type_here_review' => 'আপনার মন্তব্য দিন',
	'submit_button' => 'সাবমিট করুন',
	'cart_button' => 'কার্টে যোগ করুন',
	'whishlist_button' => 'উইসলিস্টে যোগ করুন',
	'available' => 'অবশিষ্ট',
	'not_available' => 'অবশিষ্ট নেই',
	'brand' => 'ব্র্যান্ড',
	'you_save' => 'বাচলো',
	'ratings' => 'রেটিংস',
	'write_a_review' => 'রিভিউ দিন',
	'language' => 'ভাষা',
	'products' => 'সকল পণ্য',
	'view_products' => 'পণ্যগুলো দেখুন',
	'products_categories' => 'পণ্যের ক্যাটাগরি',
	'featured_products' => 'ফিচার্ড পণ্য',




];
