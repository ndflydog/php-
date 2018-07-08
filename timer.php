<?php
 
function signal_handler($signal) {
    //do your work here
    print "Caught SIGALRM\n";
    pcntl_alarm(3);
}
 
pcntl_signal(SIGALRM, "signal_handler", true);
pcntl_alarm(3);
 
while(1) {
    pcntl_signal_dispatch();
    sleep(10);
}