Crunch\CacheControl
===================
Control over the APC/OpCache in FPM-instances.

* [List of available packages at packagist.org](http://packagist.org/packages/crunch/cache-control)

Interact with shared-memory (opcode-)caches of an FPM-instances directly. It is completely independent
from any webserver, or even application.

Usage
=====
    bin/cache-control clear [--host <hostname|socket>]

That's all for now (but works fine). `status` is planned and suggestions are appreciated.

Notes
=====

* This only works for local FPM-instances. Maybe I'll find a way to push the code
    directly to the FPM-instances, instead just the filenames ;)
* Make sure, that no file is somehow public accessible.

Requirements
============
* PHP => 5.3

Contributors
============
See CONTRIBUTING.md for details on how to contribute.

* Sebastian "KingCrunch" Krebs <krebs.seb@gmail.com> -- http://www.kingcrunch.de/ (german)

License
=======
MIT
