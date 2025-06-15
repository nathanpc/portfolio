# Rebuilt the website (again)

I guess the only I do with this website is rebuild it... Once again I
decided to redo the entire thing. In less than a year this website has
been built from scratch, and rebuilt completely twice.

The reason for the rebuild this time was out of frustration. Even though I was
fairly happy with [blog:2024-11-15_this-as-static-website|the static website I had built],
I couldn't really edit it and test my changes on any of my old computers,
largely because of the requirement on PHP 8. This made me very frustrated, since
one of the joys of having such a simple and minimalistic website is to use it
and edit it on older machines.

After much frustration I did decide to pull the trigger on the rewrite and
basically reverted everything to how things were
[https://github.com/nathanpc/portfolio/tree/97b1234e2da81719dd5fa9142bd4c7779162def2|before the static rewrite],
although I made a whole bunch of changes to make it more maintainable in the
long run, especially since the old code for the website was littered with
special functions for blog posts that I had to look up every time I made a post.

All in all the website is now in a much better state, the code for it is
cleaner, it's easier to maintain, many of the processes used to administer it
adhere to the UNIX philosophy, and I can basically work on it on any machine I
desire.

Maybe one day I will implement an RSS feed generator for the blog and actually
make use of [https://github.com/nathanpc/portfolio/blob/52b256478712c2d6552bb1d93e0095c2aabea71c/src/compat.php|all those `compat_*` functions]
that are supposed to make the website work with older web browsers.
