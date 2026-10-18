# Frequently Asked Questions

---
## Contents

* [Why?](#1)
* [How do I use these snippets?](#2)
* [How are points calculated?](#3)
* [How can I contribute?](#4)
* [How can I contact the site creator?](#5)

---

### <a name="1"></a>Why?
I finally wanted to learn how to use [Vim](http://www.vim.org/) properly. The best way to takle a task such as this, is to work on a real project and so I built this site. It is heavily inspired by [commandlinefu](http://commandlinefu.com), hence the selection of the URL & name.

While learning, I was constantly searching the world wide web for good resources on how to better use Vim and what to put in my `.vimrc` file to take advantage of Vim's plentiful features. Since there was no central resource to look into, I came up with the idea for the website you are currently enjoying. I hope this site will become, what I was was searching for as a newbee and a way for experts to collect their knowledge and share it with the world.

### <a name="2"></a>How do I use these snippets?
Vim is configured via a special file, `~/.vimrc` on UNIX style systems or `%HOME%/.vimrc` on Windows. The best way to open your configuration file is from within Vim itself by typing `:edit $HOME/.vimrc`.

You can then copy [snippets](/snippet) from this site into your .vimrc file and reload the settings with `:source %`.

### <a name="3"></a>How are points calculated?
Every User can up-vote (+1) or down-vote (-1) on each snippet. Points are then simply summed up to arrive at the final score for the snippet. To vote on snippets, go to the respective snippet page (e.g. snippet#1) and click the up- or down arrow in the upper right hand corner (or just below the title, on small screen sizes).

If you post a new snippet, you automatically give it an up-vote. This can be changed later on the snippet page, if you want.

### <a name="4"></a>How can I contribute?
Simply click the [New Snippet](/snippet/create) button in the toolbar to add a new snippet to the site.

Fill in a descriptive title, so people can grasp at a glance what your snippet is about. In the second field you can describe in detail what your snippet is about and what behaviour it adds or which settings it changes. You can use a limited set of markdown to style your description. To get formatting help, click on the words "some markdown" below the text field.

Finally paste your snippet code in the third text field and click on submit. Your snippet will immediately appear on the [home page](/) on top of the "New Snippets" section and on your user profile, which you can see by clicking on your name in the toolbar.

This site's code is open source. If you would like to help with the development of the application, please read [CONTRIBUTING](https://github.com/florianbeer/vimrcfu/blob/master/CONTRIBUTING.md) on GitHub.

### <a name="5"></a>How can I contact the site creator?
The easiest way to get in touch is via Twitter [@azath0th](http://twitter.com/azath0th).

If you found a bug or would like to suggest a new feature, please open an [issue](https://github.com/florianbeer/vimrcfu/issues) on GitHub.
