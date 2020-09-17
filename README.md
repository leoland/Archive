# Archive
At Helio I built a pre-Gutenberg block framework to build our sites on. it relied on ACF's flexible layout and named template parts to streamline the production of sites, give users bespoke freedom without the anxiety of the house of cards many page builders seem to be.
The framework was built on top of a SASSy underscores starter build and allowed multiple developers to work on it however they felt comfortable whilst maintaining a sense of standardization.
Although I had plenty of help in the form of design and additional humans to sound board off of, I coded all of these themes alone, give or take a couple of internet sourced snippets.

Vermont Mountainbike Association: 
https://vmba.org/ 
After a couple of cautious trial builds on Helios framework VMBA's site was the first build where I let loose with it. Because much of the block functionality (give or take modifications) was already worked out I was able to put more time into working directly with a fresh designer and had a lot of input into how interfaces would look and behave.


Kedrion Portal: 
https://iir.kedrion.us/ 
Much of this site is a maze of forms behind logged in user flags. Nevertheless it was a fun exercise in matching their current site. Additionally this was the first time a client specifically requested that their site attempt to meet some level of Accessibility standards (this request did not keep them from fighting us on it) Sometimes this meant I had to push against existing designs but it was lovely that advocating for the user was as easy as pointing to a requested spec.

The future is now Conference: 
https://thefutureisnow.2civility.org/ 
Sadly a victim of the pandemic, This site for a conference went unused this year. The main goal for this site was to map a section of a site, cumbersomely updated every year, To its own conference site with areas to feature more content and grow attendance. Rather than force the folks at 2civ to recreate the same pages every year, the site is largely generated from speaker and talk custom pot types. After struggling to agree with the client on how schedules would function I landed on basically the same approach used for WordCamps. 


Access to Justice: 
https://atjprod.wpengine.com/
After well over a year of debate this was Helio’s first build in which I attempted to meld our framework approach to a site that did not rely on the classic editor plugin to keep clients happy. I chose a similar approach with Advanced Custom Fields rather than relying on custom block libraries or building them from scratch to maintain a more familiar workflow for me or anyone on the team who’d maintain the site. There were challenges… And it started off more complicated than it needed to be. However My favorite part about this build is that it accounts for the editors ability to nest blocks inside one another (thus exponentially large number of contexts in which a block may appear.) Most if not all (that I remember) blocks rely on css3 properties rather than media queries for their responsiveness. This means that though many user content choices might look terrible or ill conceived they won't look broken