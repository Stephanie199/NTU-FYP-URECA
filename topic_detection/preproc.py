#!/usr/bin/env python
#Preprocessing files

import nltk
from nltk.corpus import stopwords
from nltk.stem.wordnet import WordNetLemmatizer
from nltk.stem import PorterStemmer
from num2words import num2words
from ast import literal_eval
import numpy as np
import itertools
import sys
import codecs
import re
import string

def remove_stopwords(res):
    result=[]
    stopset=set(stopwords.words("english"))
    for item in res:      
        filtered=[word for word in item if word not in stopset]
        result.append(filtered)
    #print(result)
    print("Task 1: Stopwords removed successfully")

    return result



def lem_data(apos):
    lem=[]
    wordnet_lemmatizer=WordNetLemmatizer()
    for each in apos:
        final=[]
        for n in each:
            r=wordnet_lemmatizer.lemmatize(n)
            final.append(r)
        lem.append(final)
    print("Task 2: Lemmatization completed successfully!")
    return lem


def stem_data(dt):
    stem=[]
    apos=[]
    stemmer=PorterStemmer()
    for each in dt:
        final=[]
        for n in each:
            r=stemmer.stem(n)
            final.append(r)
        stem.append(final)
    stem=[[digitsToWords(subitem) for subitem in item] for item in stem]
    print("Task 3: Stemming, number to text conversion done")

    
    with codecs.open("files/processed.txt", "w", 'utf8') as f:
        for eachitem in stem:
            for every in eachitem:
                f.write(every+' ')
            f.write('\n')    
        f.close()
    return stem

             

def digitsToWords(item):
    if isinstance(item, (int, long)):
        return num2words(item)

    if isinstance(item, (str, unicode)) and item.isdigit():
        return num2words(int(item))

    return item

def remove_apos(stemmed):
    for suffix in ["'s", "'v", "'t", "'d", "'r", "'"]:
        if stemmed.endswith(suffix):
            return stemmed[:-len(suffix)]
    return stemmed
    #print(n)
   

dataset=[]
quotes_to_remove = [u"'", u"\u2019", u"\u2018"]
lines = []
res=[]

with codecs.open("files/textfile.txt", "r", "utf-8") as f:
    for line in f:
        dataset.append(line.lower().strip().split())
    print(dataset)

for l in dataset:
    new=[]
    for word in l:
        for quote in quotes_to_remove:
            word=word.replace(quote,"")
        new.append(word)
    res.append(new)


punc=res
punc=[[x.strip(string.punctuation) for x in y] for y in punc]


lines=[sum((line for line in punc if line), [])]
print(punc)

print("Task 1: Apostrophe and punctuation removed")
nostop=remove_stopwords(lines)

lemmed=lem_data(nostop)
apos=stem_data(lemmed)




