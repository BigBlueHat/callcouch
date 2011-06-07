CallCouch is a small (34 line) PHP script you can host at Tropo to communicate with your CouchDB database via IM or SMS.
It currently has two main features (or verbs): get & send.

There is a demo version running at callcouch@tropo.im if you'd like to try out the following verbs.

## [get ]document

The verb "get" is optional as it's the default. This will retrieve the document from CouchDB and return it.

Try: get bigbluehat

NOTE: currently, CallCouch is setup to work against documents that have a name, url, and email fields. You could easily
change that for your installation.

## send ###-###-#### document

Send let's you bridge the messaging world and send an IM to callcouch@tropo.im and have the resulting document sent to
the phone number of your choice.

## History

CallCouch was built during the Tek11 Hack-a-thon sponsored by Tropo. It placed third, and was the
only winner developed by a single person. Thanks for the Kindle, Tropo!

## LICENSE

As usual, this is licensed under the Apache License 2.0.
