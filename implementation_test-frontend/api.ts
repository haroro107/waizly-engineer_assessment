import { ITask } from "./types/tasks";
import { IUniversity } from "./types/university";

const baseUrl = "http://localhost:3001";
const PublicApiUrl = "http://universities.hipolabs.com/search?name=bandung&country=indonesia";

export const listTodo = async (name: string | null): Promise<ITask[]> => {
   if (name === null || name.trim() === "") {
      const res = await fetch(`${baseUrl}/tasks`, { cache: "no-store" });
      const tasks = await res.json();
      return tasks;
   } else {
      const lowercaseName = name.toLowerCase();
      const res = await fetch(`${baseUrl}/tasks?text=${encodeURIComponent(lowercaseName)}`, { cache: "no-store" });
      const tasks = await res.json();
      return tasks;
   }
};

export const addTodo = async (todo: ITask): Promise<ITask> => {
   const res = await fetch(`${baseUrl}/tasks`, {
      method: "POST",
      headers: {
         "Content-Type": "application/json",
      },
      body: JSON.stringify(todo),
   });
   const newTodo = await res.json();
   return newTodo;
};

export const editTodo = async (todo: ITask): Promise<ITask> => {
   const res = await fetch(`${baseUrl}/tasks/${todo.id}`, {
      method: "PUT",
      headers: {
         "Content-Type": "application/json",
      },
      body: JSON.stringify(todo),
   });
   const updatedTodo = await res.json();
   return updatedTodo;
};

export const deleteTodo = async (id: string): Promise<void> => {
   await fetch(`${baseUrl}/tasks/${id}`, {
      method: "DELETE",
   });
};

export const statusTodo = async (id: string): Promise<void> => {
   const task = await fetch(`${baseUrl}/tasks/${id}`);
   const taskData: ITask = await task.json();

   const newStatus = taskData.status === 0 ? 1 : 0;

   await fetch(`${baseUrl}/tasks/${id}`, {
      method: "PUT", // Use PUT or PATCH depending on your API.
      headers: {
         "Content-Type": "application/json",
      },
      body: JSON.stringify({ ...taskData, status: newStatus }),
   });
};

export const getPublicApi = async (): Promise<IUniversity[]> => {
   const res = await fetch(`${PublicApiUrl}`, { cache: "no-store" });
   const publicApi = await res.json();
   return publicApi;
};
