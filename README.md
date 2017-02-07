# Papeterie
A plugin to create and edit paper documents for Kirby CMS.

Because of the way page break is managed and repeating elements are handled, it is much easier to use a page break manually.
By default it is === but you can change this by setting, in your config.php:
```
c::set('papeterie.page_break','%%%');
```
Also change the instructions for the "text" field in `blueprints/papeterie_document.yml`.

## What Papeterie does

It turns this

![image](https://cloud.githubusercontent.com/assets/1948417/22690718/6f1bf658-ed37-11e6-917b-86fa1489a4fe.png)

![image](https://cloud.githubusercontent.com/assets/1948417/22690726/785095c6-ed37-11e6-9335-576994869288.png)

to this

![image](https://cloud.githubusercontent.com/assets/1948417/22690828/d867f68e-ed37-11e6-9db6-548e7a243bad.png)

![image](https://cloud.githubusercontent.com/assets/1948417/22690840/dfeb9938-ed37-11e6-9859-605e26bc2f34.png)

![image](https://cloud.githubusercontent.com/assets/1948417/22690841/e19077a4-ed37-11e6-93f5-a140f72a052a.png)

and to this (for printing)

![image](https://cloud.githubusercontent.com/assets/1948417/22709455/23ac9680-ed7a-11e6-8d9a-28d1086c9915.png)
