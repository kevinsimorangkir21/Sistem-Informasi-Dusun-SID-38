<div align="center">
<h1> Sistem Informasi Dusun (SID) 3B </h1>
<h2> Version : 0.1 (Beta) <h2>

[![Github Commit](https://img.shields.io/github/commit-activity/m/kevinsimorangkir21/SID38)](#)
[![Github Contributors](https://img.shields.io/badge/all_contributors-6-orange.svg)](#)

</div>

## **Table Of Contents**

[Introduction Website](#)

[Features Website](#)

[Installation Steps](#)

[License](#)

[UI/UX](#)

[Implementation](#)

[Presentation Video](#)

## **Introduction Website**

The Dusun 3B Information System, abbreviated as SID 3B, is an Information System aimed at Hamlet 3B in Karang Anyar Village, Jati Agung District, South Lampung. SID38 is based on a CMS (`<i>`Content Management System`</i>`) using Laravel 5 and Bootstrap framework. SID 3B contains several news, management structures, galleries, and others.

## **Features Website**

<li> <b>Dashboard</b> : A feature that aims to organize the content/material on the SID38 website </li> <li><b>Structure</b> : This feature aims to find out the existing management structure in Hamlet 3B <li> <b>News </b> : A feature created with the aim of displaying news in Hamlet 3B <li><b>Galeri</b> : A feature created with the aim of displaying a gallery of activities in Hamlet 3B </li>

## **Installation Steps**

There are 2 stages in the Installation Stage, namely Pre-Install & Intra-Install

### **Pre-Install**

Prepare the tools needed, namely:

<li> Composer :</li>

```bash
https://getcomposer.org/download/
```

<li> Laravel 5 :</li>

```bash
https://laravel.com/docs/10.x
```

<li> XAMPP :</li>

```bash
https://www.apachefriends.org/download.html
```

<li> Git Bash :</li>

```bash
https://git-scm.com/downloads
```

### **Intra-Install**

<li> Jalankan GitBash dan <i>clone</i> repository GitHub ini</li>

```bash
https://github.com/kevinsimorangkir21/SID3B.git
```

<li> Open Visual Studio Code / Kode Editor lainnya </li>

<li> Jalankan Command Prompt / Terminal sejenisnya </li>

```bash
composer update
```

<li> Jalankan XAMPP, buat database. Bisa diakses pada link berikut </li>

```bash
http://localhost/phpmyadmin
```

<li> Copy .env.example  / jalankan CLI dengan command :</li>

```bash
cp .env.example .env
```

<li> Ubah file nama .env.example menjadi .env </li>

```bash
http://localhost/phpmyadmin
```

<li> Akses kembali file .env dan ubah DB_DATABASE dengan nama database yang sudah dibuat di LocalHost </li>

<li> Jalankan kembali Command Prompt / Terminal dan inputkan : </li>

```bash
php artisan migrate:fresh --seed
```

```bash
php artisan vendor:publish
```

```bash
php artisan key:generate
```

<li> Untuk mengakses projek ini di web, jalankan command : </li>

```bash
php artisan serve
```
