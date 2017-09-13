# Finance Buddy (or something like that)

A simple application to help people who survive paycheck to paycheck manage their finances in a better way.

## Getting Started

First, git clone this thing.  Then look at it.  If you can't figure out how to install it from looking at it then you are probably not the right person for the job.

### Prerequisites

* warm blood in your veins
* a computer
* electricity
* git
* some sort of text editor
* your brain

```
Give examples
```

F you! and F this README template.  Here is what is going on:

I conceive this project a few years ago.  The original idea was to have an application where users could enter all of their reoccurring debits and credits and also their current bank acount balance and the system would generate a graphical representation of what their bank balance would be in the future assuming that the same pattern of debits and credits continue.

Debits and credits would be things like pay checks and monthly bills etc.  Each one would be entered along with the interval between the reoccurrence.  The idea was that it is very difficult for people to preduct financial problems when the intervals between all of these transactions were not the same.  For example, many people receive their pay on ever other friday, however their rent is due on the first of the month.  This creates a problem because of the timing.  Sometimes you get paid right before rent is due and everything is fine, other times you get paid 5 days after the rent is due and you find yourself screwed.  Our application would solve this problem by showing you where these deficits might occurr in the future.

That was it.  This is the basic MVP (Minimum Viable Product) of the application.

What next?

Well, first I tried solving my own financial problems by putting this kind of data into a spreadsheet.  What I quickly learned is that nomatter how accurrately i put in my repeating transactions i always missed something.  I was alway innaccurate in predicting my spending so i started to include a factor of error calculation.  In the next phase of the application we will try to automate this feature by periodically querying the user to get their current bank balance.  Based on the difference between this balance and what they put in, we should be able to predict how off their calculations are and then factor that in to the financial predicitons.

More ideas:

* Can i afford this right now?
* How am i doing in general?
* How can i save for something i want?



### Installing

git clone this into your local repo 

```
git clone git@github.com:dallascaley/finance.git
```

Find the finance.sql file and run it (manually) in your db, also run each of the files in the migrations folder individually.  Sorry, there is no auto-migration script yet.

```
mysql -u youruser -p finance < finance.sql
```

set up your etc/hosts file and the vhost files in apache to point to the root of this repo

## Running the tests

There are no tests yet

## Built With

This application uses no frameworks at all (yet)

* [Google](http://www.google.com) - Just google that shit
* [jQuery](https://jquery.com) - jQuery.  It literally does everything you could ever want with respect to javascript.  Nothing else needed.  Period.

## Contributing

If you want to contribute to this project go right ahead.  But don't plan on me merging in your crappy changes.  This is my project.  Go away.

## Versioning

Version 0.1

## Authors

* **Dallas Caley** - *dallascaley@gmail.com* - [dallascaley.info](http://www.dallascaley.info)

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details

## Acknowledgments

* All hail the Flying Spaghetti Monster
* Ramen