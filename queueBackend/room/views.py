# -*- coding: utf-8 -*-
from __future__ import unicode_literals
from django.http import HttpResponse
from django.shortcuts import render
from models import Question, Room

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
    while isExists(code):
        code = ''.join([random.choice(alpha) for _ in range(4)])

    newRoom = Room(code=code)
    newRoom.save()
    return HttpResponse("Creating room. Code "+code)

def delete(request):
    Room.objects.all().delete()
    return HttpResponse("Deleteing all rooms")

def isExists(code):
    roomSet = Room.objects.all()
    return roomSet.filter(code=code).exists()

def createCode(request, roomid):
   newRoom = Room(code=roomid)
   if isExists(roomid):
       return HttpResponse("Error: Room exists")
   else:
       newRoom.save()
       return HttpResponse("Room created")
