import "./globals.css";
import type { Metadata } from "next";

export const metadata: Metadata = {
   title: "Todo App | Renaldi",
   description: "Created by Renaldi Putra",
};

export default function RootLayout({ children }: { children: React.ReactNode }) {
   return (
      <html lang="en" className="bg-slate-800">
         <body>{children}</body>
      </html>
   );
}
