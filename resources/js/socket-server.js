// socket-server.js

const { createServer } = require("http");
const { Server } = require("socket.io");
const Redis = require("ioredis");

// Set up HTTP server
const httpServer = createServer();
const io = new Server(httpServer, {
  cors: {
    origin: "*", // allow all origins (for testing)
    methods: ["GET", "POST"]
  }
});

// Set up Redis connection
const redis = new Redis();

// Subscribe to all Redis channels
redis.psubscribe("*", (err, count) => {
  if (err) {
    console.error("Failed to subscribe:", err.message);
  } else {
    console.log("✅ Subscribed to all Redis channels");
  }
});

// On receiving message from Redis (broadcasted by Laravel)
redis.on("pmessage", (pattern, channel, message) => {
  console.log("📨 Redis message received:", channel, message);

  const data = JSON.parse(message);

  // Emit to all connected Socket.IO clients
  io.emit(channel, data);
});

// Start Socket.IO server
const PORT = 3000;
httpServer.listen(PORT, () => {
  console.log(`🚀 Socket.IO server running on port ${PORT}`);
});
