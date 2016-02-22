#!/usr/bin/env python
#Preprocessing files

import nltk
from nltk.corpus import stopwords
from nltk.stem.wordnet import WordNetLemmatizer
from nltk.stem import PorterStemmer
from num2words import num2words
from ast import literal_eval
import numpy as np
import sys


def remove_stopwords(dataset):
    result=[]
    stopset=set(stopwords.words("english"))
    for item in dataset:
        filtered=[word for word in item if word not in stopset]
        result.append(filtered)
    print("Task 2: Stopwords removed successfully")
    #return result
   
    return result 


def lem_data(dt):
    lem=[]
    wordnet_lemmatizer=WordNetLemmatizer()
    for each in dt:
        final=[]
        for n in each:
            r=wordnet_lemmatizer.lemmatize(n)
            final.append(r)
        lem.append(final)
    print("Task 3: Lemmatization completed successfully!")
    return lem

def stem_data(lemmed):
    stem=[]
    apos=[]
    stemmer=PorterStemmer()
    for each in lemmed:
        final=[]
        for n in each:
            r=stemmer.stem(n)
            final.append(r)
        stem.append(final)
    stem=[[digitsToWords(subitem) for subitem in item] for item in stem]

    for n in stem:
        final=[]
        for y in n:
            r=remove_apos(y)
            final.append(r)
        apos.append(final)
    print("Task 4: Stemming, number to text conversion and apostrophy removed!")           

    with open("/Applications/XAMPP/xamppfiles/htdocs/files/processed.txt", "w") as f:
        for eachitem in apos:
            for every in eachitem:
                f.write(every+' ')
            f.write('\n')    
        f.close()
    return apos 

def digitsToWords(item):
    if isinstance(item, (int, long)):
        return num2words(item)

    if isinstance(item, (str, unicode)) and item.isdigit():
        return num2words(int(item))

    return item

def remove_apos(stemmed):
   
    for suffix in ["'", "'v", "'t", "'d", "'r"]:
        if stemmed.endswith(suffix):
            return stemmed[:-len(suffix)]
    return stemmed
    #print(n)
   


dataset=[]
with open(sys.argv[1], "r") as fil:
    for line in fil:
        dataset.append(line.strip().split())
nostop=remove_stopwords(dataset)
lemmed=lem_data(nostop)
apos=stem_data(lemmed)

