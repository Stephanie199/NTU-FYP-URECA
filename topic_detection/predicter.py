#!/usr/bin/env python

from sklearn.externals import joblib
from sklearn.linear_model import LogisticRegression
from sklearn.metrics import confusion_matrix
from scipy import sparse
from sklearn import metrics
import subprocess
import numpy as np
import sys
import csv
import codecs

clf=joblib.load("withlogr.pkl")

def get_pair(line):
  key, sep, value = line.strip().partition("\t")
  return int(key), value


with open("mapped.txt") as fd:    
           d = dict(get_pair(line) for line in fd if '\t' in line.strip())
#print(d)



f = open("FINALVOCAB.txt","r")
vocab_tmp = f.read().split()
f.close()
col = len(vocab_tmp)
print("Test column size:")
print(col)
     
#dataset = list()
with open(sys.argv[1]) as myfile:
    row=sum(1 for line in myfile)

print("Test row size:")
print(row)
matrix_tmp_test = np.zeros((int(row),col), dtype=np.int64)
print("Test matrix size:")
print(matrix_tmp_test.size)
        


#Create document-term matrix
f = open(sys.argv[1],"r")
count = 0
for line in f:
    line_tmp = line.split()
    #print(line_tmp)
    for word in line_tmp[0:]:
        if word not in vocab_tmp:
            continue
        matrix_tmp_test[count][vocab_tmp.index(word)] = 1
    count = count + 1
f.close()
print("Test Matrix is: \n")
print(matrix_tmp_test)


mat_tmp_test=sparse.csr_matrix(matrix_tmp_test)

r=clf.predict(mat_tmp_test)


#Top 1 and Top 5 computation
y_d=clf.predict_log_proba(mat_tmp_test)

order=np.argsort(y_d, axis=1)
predicted_sorted = y_d[np.arange(y_d.shape[0]),order.T].T
zen=predicted_sorted[:,-5:]
prob5=zen[:,::-1]
print(prob5)

predicted1=y_d[np.arange(y_d.shape[0]),order.T].T
zep=predicted1[:,-1:]
prob1=zep[:,::-1]
print(prob1)
n=clf.classes_[order[:, -5:]]
k=n[:,::-1]

r=clf.classes_[order[:, -1:]]



with open("files/outputfile.txt",'w') as f:
    f.write("Topic Predicted ->")
    for co in r:
        t=' '.join(str(p) for p in co)
        f.write(t)
        f.write("\t")
        f.write(d.get(int(t)))
        f.write("\n \n")
  
 #   for po in prob1:
#        nk=' '.join(str(x) for x in po)
#        f.write("(" + nk + ")")
#        f.write("\n \n")
    
  
    f.write("Top 5 Probable Topics:")
    #print the labels
    for row in k:
        s=', '.join(str(x) for x in row)
        f.write(s)
        f.write("\n")
        w=map(int, s.split(','))
        
 #get the topics             
    for item in w:
        f.write(d.get(int(item)))
        f.write(", ")
    for pk in prob5:
        jk=', '.join("%.4f" %b for b in pk)
        jk="("+jk+ ")" + "\t"
        f.write(jk)

       
print("Done printing")
