# ishb.github.io

ISHB public site

http://ishb.github.io.

https://help.github.com/articles/user-organization-and-project-pages/

## Running

Dev mode

    jekyll serve --watch # jekyll s -w

Create deployment bundle



## Scriptable Steps for making a static site like this

1. Make github organization
2. make repo in that org with named `ORGNAME.github.io`
3. `clone https://github.com/ORGNAME/ORGNAME.github.io.git`
4. `cd ORGNAME.github.io.git`
4. `jekyll new . --force` # force ignores the readme file that might already be there


## Objectives

- [ ] sass compilation
- [ ] live reload dev server
- [ ] min-cat deployed version
- [ ] `data` section
- [ ] bootstrap