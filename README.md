# Papeterie
A plugin to create and edit paper documents, for Kirby CMS.

## Description

Documents are created in the panel and display in a specific A4 template, client-side. They can be printed or saved as PDF using the browser's PDF printer. Their URL can be shared or kept private on a per-document basis.

Refer to the screenshots below for more informations

## Screenshots

In the panel:

![image](https://cloud.githubusercontent.com/assets/1948417/22690718/6f1bf658-ed37-11e6-917b-86fa1489a4fe.png)

![image](https://cloud.githubusercontent.com/assets/1948417/22690726/785095c6-ed37-11e6-9335-576994869288.png)

Once filled, documents look like this:

![image](https://cloud.githubusercontent.com/assets/1948417/22690828/d867f68e-ed37-11e6-9db6-548e7a243bad.png)

![image](https://cloud.githubusercontent.com/assets/1948417/22690840/dfeb9938-ed37-11e6-9859-605e26bc2f34.png)

![image](https://cloud.githubusercontent.com/assets/1948417/22690841/e19077a4-ed37-11e6-93f5-a140f72a052a.png)

Specific CSS @page queries enable clean printing of documents:

![image](https://cloud.githubusercontent.com/assets/1948417/22709455/23ac9680-ed7a-11e6-8d9a-28d1086c9915.png)

## Options

Because of the way page break is managed and repeating elements are handled, it is much easier to use a page break manually.
By default it is === but you can change this by setting, in your config.php:
```
c::set('papeterie.page_break','%%%');
```
Also change the instructions for the "text" field in `blueprints/papeterie_document.yml`.

## Bugs

Because of the way @page is handled, it is strongly advised to use a recent browser such as Chrome 58 for saving pages as PDF. Displaying documents has broader support and more uniform look across browsers.

## License / credits

MIT license.

Plugin initially developed by [Louis Eveillard](https://louiseveillard.com/) for [rh+ architecture](http://www.rhplus-architecture.com/). Contributors include [mciszczon](https://github.com/mciszczon) and [texnixe](https://github.com/texnixe).


