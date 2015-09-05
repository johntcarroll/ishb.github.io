# ishb.github.io

This is the repo for the [public site](http://ishb.github.io/) of ISHB.

It is hosted on github pages which is fast, free, and easy to deploy.

It uses Jekyll so it's ready to support a world-class blog with permalinks, xml feed, and more.

## Adding/Editing Content

Content is written in [Markdown](https://github.com/adam-p/markdown-here/wiki/Markdown-Cheatsheet), a safe version of text that supports headings and basic formatting like bold, bullet points, and italics.

Anyone who can edit a text file can use it and update the site.

## Add a Testimonial

### Create a file in `testimonials/_posts`

All files in this folder which are named like `YYYY-MM-DD-some-name.md` will turn into testimonials. The date isn't used except for determining the order.

### Fill in the content

Copy from a previous one so you know which fields to fill in (linkedIn, website, etc)

## Add an "About Us" Snippet

Same process as for testimonials, described above.

## Editing Other Content

You can edit any of the files in the folder `_includes/content`. They've been named to try to make it easy to tell which one shows up where.



## Developing

Dev mode

    jekyll serve --watch

Create deployment bundle

    jekyll build


## Scriptable Steps for making a static site like this

1. Make github organization
2. make repo in that org with named `ORGNAME.github.io`
3. `clone https://github.com/ORGNAME/ORGNAME.github.io.git`
4. `cd ORGNAME.github.io.git`
4. `jekyll new . --force` # force ignores the readme file that might already be there
1. set the repo description to include a link to the deployment location

## Objectives

- [x] sass compilation
- [ ] live reload dev server
- [x] min-cat deployed version
- [x] `data` section
- [x] bootstrap
- [x] content section full of markdown
