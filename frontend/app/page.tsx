import { redirect } from "next/navigation";

export default function PagesIndex() {
  // Rediriger vers le dashboard
  redirect("/dashboard");
}
