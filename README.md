

_jb
===

Hi. I'm a starter theme called `_jb`, or `underscore_jb`, if you like. I'm a theme meant for hacking so don't use me as a Parent Theme. Instead try turning me into the next, most awesome, WordPress theme out there. That's what I'm here for. I'm based on Automattic's [_s (underscores)](http://underscores.me).

My ultra-minimal CSS might make me look like theme tartare but that means less stuff to get in your way when you're designing your awesome theme. Here are some of the other more interesting things you'll find here:

* Grunt tasks to process & minimize Sass & Javascript, and to run [Browsersync](https://browsersync.io/).
* A just right amount of lean, well-commented, modern, HTML5 templates.
* A helpful 404 template.
* A custom header implementation in `inc/custom-header.php` just add the code snippet found in the comments of `inc/custom-header.php` to your `header.php` template.
* Custom template tags in `inc/template-tags.php` that keep your templates clean and neat and prevent code duplication.
* Some small tweaks in `inc/template-functions.php` that can improve your theming experience.
* A script at `js/navigation.js` that makes your menu a toggled dropdown on small screens (like your phone), ready for CSS artistry. It's enqueued in `functions.php`.
* 2 sample CSS layouts in `layouts/` for a sidebar on either side of your content.
* Smartly organized starter CSS in `style.css` that will help you to quickly get your design off the ground.
* Licensed under GPLv2 or later. :) Use it to make something cool.

Getting Started
---------------

_jb doesn't have a fancy website like [underscores.me](http://underscores.me) that will download a customized, renamed, version for you, but it does have a cool [Grunt](http://gruntjs.com/) task to rename the theme from _jb to whatever your project is actually called. 

After you clone or download `_jb` from GitHub. The first thing you want to do is copy the `_jb` directory and change the name to something else (like, say, `john-is-awesome`), and then you'll want to fire up your favourite terminal and get run the Grunt setup-project task:

1. `cd` into your new `john-is-awesome` directory
2. Run `npm install` to install Grunt & any dependencies, (this assumes you have Node installed already).
3. Run `grunt setup-project --project-name=john-is-awesome`

Finally, update the stylesheet header in `style.css` and the links in `footer.php` with your own information. Next, update or delete this readme.

Auto-Building Sass and Javascript as you work
---------------------------------------------

The Gruntfile has a default task that watches your Sass, Javascript, and PHP files to compile and minify the Sass and Javascript when they're changed, (don't worry - there are sourcemaps!), and update the browser with Browsersync when Sass, Javascript, or PHP gets changed. 

The Browsersync task expects your project to be hosted on the local domain http://name-you-set-in-setup-above.dev, (it defaults to http://_jb.dev), so you might want to update your `hosts` file to point to whatever IP your development webserver lives on.

Go Build Something Great
------------------------

Now you're ready to go! The next step is easy to say, but harder to do: make an awesome WordPress theme. :)

Good luck!
