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

1: Can i afford this right now?
2: How am i doing in general?
3: How can i save for something i want?




### Installing

A step by step series of examples that tell you have to get a development env running

Say what the step will be

```
Give the example
```

And repeat

```
until finished
```

End with an example of getting some data out of the system or using it for a little demo

## Running the tests

Explain how to run the automated tests for this system

### Break down into end to end tests

Explain what these tests test and why

```
Give an example
```

### And coding style tests

Explain what these tests test and why

```
Give an example
```

## Deployment

Add additional notes about how to deploy this on a live system

## Built With

* [Dropwizard](http://www.dropwizard.io/1.0.2/docs/) - The web framework used
* [Maven](https://maven.apache.org/) - Dependency Management
* [ROME](https://rometools.github.io/rome/) - Used to generate RSS Feeds

## Contributing

Please read [CONTRIBUTING.md](https://gist.github.com/PurpleBooth/b24679402957c63ec426) for details on our code of conduct, and the process for submitting pull requests to us.

## Versioning

We use [SemVer](http://semver.org/) for versioning. For the versions available, see the [tags on this repository](https://github.com/your/project/tags). 

## Authors

* **Billie Thompson** - *Initial work* - [PurpleBooth](https://github.com/PurpleBooth)

See also the list of [contributors](https://github.com/your/project/contributors) who participated in this project.

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details

## Acknowledgments

* Hat tip to anyone who's code was used
* Inspiration
* etc