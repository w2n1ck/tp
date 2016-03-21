import json
import base64
a=open('ip.txt').readlines()
i=0
d={}
for line in a:
    b=line.split('|')
    b0=b[0].split('.')
    b0_num=''.join(b0)
    b1=b[1].split('.')
    b1_num=''.join(b1)
    b2= base64.b64encode(b[2])
    c=[b0_num,b1_num,b2]
    i+=1
    d[str(i)]=c
open('ip.json','w').write(json.dumps(d))



    
