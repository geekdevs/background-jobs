# Example running background jobs and logging its output (stdout, stderr, exit code)

It makes use of the following awesome libs:

- [php-shellcommand](https://github.com/mikehaertl/php-shellcommand) to execute commands (based on [proc_open](http://php.net/manual/en/function.proc-open.php))
- [spork](https://github.com/kriswallsmith/spork) to run multiple background jobs simultaneously (based on [pcntl_fork](http://php.net/manual/en/function.pcntl-fork.php))
- [monolog](https://github.com/Seldaek/monolog) to log output of the commands (stdout, stderr, exit code)