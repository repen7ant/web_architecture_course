from fastapi import FastAPI
from fastapi.middleware.cors import CORSMiddleware
from routers import comments

app = FastAPI(title="Boardy API", version="0.2.0")

app.add_middleware(
    CORSMiddleware,
    allow_origins=["https://boardy.emrysdev.xyz"], 
    allow_credentials=True,
    allow_methods=["*"],
    allow_headers=["*"],
)

app.include_router(comments.router)
