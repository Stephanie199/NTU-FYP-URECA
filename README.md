# NTU-FYP-URECA
NTU Final Year Project and URECA - Web demo of Sentence Unit Detection and Topic Detection 

#SUD English
The objective of this project is to study approaches to detect sentence boundary from the unstructured word sequence in english language. 
In this context, word boundary is referred to the punctuations in the sentence, which we focus on only period at the moment.

The implementation of the SUD: Conditional Random Fields

Machine Learning Tools used: CRF++, SENNA Parser

Features : Language Model; n-grams (3 WordBefore + 2 WordAfter) ; Tokens (biagram); Part Of Speech tag & Chunking - IOBES tag

Training : RT-04 corpus (Broadcast News Transcript) - no.of.words:343,664 ; no.of.sentences: 26,676

Model Performance is tested against 3 different corpus and obtained average F1-score of 62.7% and NIST SU Error Rate of 72.17%


