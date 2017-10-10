# -*- coding: utf-8 -*-
from __future__ import unicode_literals
from django.http import HttpResponse

from django.shortcuts import render

# Create your views here.

def index(request):
    return HttpResponse("Hello, world. You're at the room index.")

def create(request):
    import random
    alpha = ("A", "B", "C", "D", "E",
      "F", "G", "H", "I", "J",
      "K", "L", "M", "N", "O",
      "P", "Q", "R", "S", "T",
      "U", "V", "W", "X", "Y",
      "Z", )
    code = ''.join([random.choice(alpha) for _ in range(4)])
    return HttpResponse("Creating room. Code "+code)
