import os
import sys

loc = sys.argv[1]
c = 1
os.chdir(loc)
for x in os.listdir(loc):
	os.rename(x, str(c)+'.jpg')
	c = c+1